<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\coupon;
use App\Models\country;
use App\CPU\ImageManager;

class OfferController extends Controller
{
    public function offer_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $coupon = coupon::leftjoin('countries','countries.country_id','coupons.country_id')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('coupon_title', 'like', "%{$value}%")->orWhere('coupon_code', 'like', "%{$value}%")->orWhere('amount_percent', 'like', "%{$value}%")->orWhere('coupon_description', 'like', "%{$value}%")->orWhere('country_name', 'like', "%{$value}%");
                }
            })->orderBy('coupon_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $coupon = coupon::leftjoin('countries','countries.country_id','coupons.country_id')->orderBy('coupon_id', 'desc');
        }
        $coupon = $coupon->paginate(config('default_pagination'))->appends($query_param);

        $country = country::orderBy('country_name', 'ASC')->get();
        return view('Admin.offer', compact('coupon','search','country'));
    }

    public function insert_offer(Request $request)
    {
        $data = new coupon();
        $data->country_id = $request->country_id;
        $data->coupon_title = $request->coupon_title;
        $data->coupon_code = $request->coupon_code;
        $data->coupon_type = $request->coupon_type;
        $data->amount_percent = $request->amount_percent;
        $data->coupon_validity = $request->coupon_validity;
        $data->coupon_description = 'N/A';
        $data->coupon_image = ImageManager::upload('modal/', 'png', $request->file('image'));
        $data->save();

        Toastr::success('Success! Offer Inserted');
        return redirect()->back();
    }

    public function update_offer_status($coupon_id,$coupon_status)
    {
        $data = coupon::find($coupon_id);
        $data->coupon_status=$coupon_status;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }


    public function update_offer(Request $request)
    {
        $data = coupon::find($request->coupon_id);
        if ($request->has('image')) {
            $data->coupon_image = ImageManager::update('modal/', $data['coupon_image'], 'png', $request->file('image'));
         }
        $data->country_id = $request->country_id;
        $data->coupon_title = $request->coupon_title;
        $data->coupon_code = $request->coupon_code;
        $data->coupon_type = $request->coupon_type;
        $data->amount_percent = $request->amount_percent;
        $data->coupon_validity = $request->coupon_validity;
        $data->coupon_description = 'N/A';
        $data->save();

        Toastr::success('Success! Offer updated');
        return redirect()->back();
    }
}
