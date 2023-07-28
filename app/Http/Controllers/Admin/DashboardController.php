<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_detail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {                    
        return view('Admin.dashboard');
    }

    public function order_stats(Request $request)
    {
        session()->put('statistics_type', $request['statistics_type']);
        $data = self::order_stats_data();

        return response()->json([
            'view' => view('Admin.view.dashboard-order-stats', compact('data'))->render()
        ], 200);
    }

    public function order_stats_data()
    {
        $today = session()->has('statistics_type') && session('statistics_type') == 'today' ? 1 : 0;
        $this_month = session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 1 : 0;

        $pending = order_detail::where(['order_status' => '0'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $accpeted = order_detail::where(['order_status' => '1'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $cancelled = order_detail::where(['order_status' => '4'])->orwhere(['order_status' => '5'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $completed = order_detail::where(['order_status' => '3'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();

        $data = [
            'pending' => $pending,
            'accepted' => $accpeted,
            'cancelled' => $cancelled,
            'completed' => $completed,
        ];

        return $data;
    }
}
