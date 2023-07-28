<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\restaurant;
use Brian2694\Toastr\Facades\Toastr;

class ReportController extends Controller
{
    public function order_report(Request $request)
    {
        if (!$request->has('from_date')) {
            $from = $to = date('Y-m-d');
        } else {
            $from = $request['from_date'];
            $to = $request['to_date'];
        }

        $restaurant = restaurant::orderBy('restaurant_name','ASC')->get();
        $restaurant_id='0';
        
        return view('Admin.order-report', compact('restaurant','restaurant_id','from','to'));
    }

    public function order_data(Request $request)
    {
        if (!$request->has('from_date')) {
            $from = $to = date('Y-m-d');
        } else {
            $from = $request->from_date;
            $to = $request->to_date;
        }
        $restaurant = restaurant::orderBy('restaurant_name','ASC')->get();
        $restaurant_id = $request->restaurant_id;
    
        return view('Admin.order-report', compact('restaurant','restaurant_id','from','to'));
    }
}
