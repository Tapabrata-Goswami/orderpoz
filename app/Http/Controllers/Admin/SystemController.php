<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SearchFunction;
use App\Models\order_detail;

class SystemController extends Controller
{
    public function search_function(Request $request)
    {
        $request->validate([
            'key' => 'required',
        ], [
            'key.required' => 'name is required!',
        ]);

        $key = explode(' ', $request->key);

        $items = SearchFunction::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('key', 'like', "%{$value}%");
            }
        })->get();

        return response()->json([
            'result' => view('Admin.search-result', compact('items'))->render(),
        ]);
    }

    public function store_data()
    {
        $new_booking = order_detail::where('order_status',0)->count();
        return response()->json([
            'success' => 1,

            'data' => ['new_booking' => $new_booking > 0 , 'type' => $new_booking > 0]
        ]);
    }
}
