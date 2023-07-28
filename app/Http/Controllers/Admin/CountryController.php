<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\country;
use App\CPU\ImageManager;

class CountryController extends Controller
{
    public function country_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $country = country::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('country_name', 'like', "%{$value}%")->orWhere('country_code', 'like', "%{$value}%")->orWhere('country_currency', 'like', "%{$value}%");
                }
            })->orderBy('country_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $country = country::orderBy('country_id', 'desc');
        }
        $country = $country->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.country', compact('country','search'));
    }

    public function insert_country(Request $request)
    {
        $data = new country();
        $data->country_name = $request->country_name;
        $data->country_code = $request->country_code;
        $data->country_currency = $request->country_currency;
        $data->save();

        Toastr::success('Success! Country Inserted');
        return redirect()->back();
    }

    public function update_country(Request $request)
    {
        $data = country::find($request->country_id);
        $data->country_name = $request->country_name;
        $data->country_code = $request->country_code;
        $data->country_currency = $request->country_currency;
        $data->save();

        Toastr::success('Success! Country updated');
        return redirect()->back();
    }
}
