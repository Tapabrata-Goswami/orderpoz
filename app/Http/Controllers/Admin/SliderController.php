<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\slider;
use App\Models\restaurant;
use App\CPU\ImageManager;

class SliderController extends Controller
{
    public function slider_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $slider = slider::leftjoin('restaurants','restaurants.restaurant_id','sliders.restaurant_id')->select('sliders.*','restaurants.restaurant_name')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('slider_image', 'like', "%{$value}%");
                }
            })->orderBy('slider_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $slider = slider::leftjoin('restaurants','restaurants.restaurant_id','sliders.restaurant_id')->select('sliders.*','restaurants.restaurant_name')->orderBy('slider_id', 'desc');
        }
        $slider = $slider->paginate(config('default_pagination'))->appends($query_param);
        $restaurant = restaurant::orderBy('restaurant_name', 'ASC')->get();
        return view('Admin.slider', compact('slider','search','restaurant'));
    }

    public function insert_slider(Request $request)
    {
        $data = new slider();
        $data->restaurant_id = $request->restaurant_id;
        $data->slider_image = ImageManager::upload('modal/', 'png', $request->file('image'));
        $data->save();

        Toastr::success('Success! Slider Inserted');
        return redirect()->back();
    }

    public function update_slider(Request $request)
    {
        $data = slider::find($request->slider_id);
        if ($request->has('image')) {
            $data->slider_image = ImageManager::update('modal/', $data['slider_image'], 'png', $request->file('image'));
        }
        $data->restaurant_id = $request->restaurant_id;
        $data->save();

        Toastr::success('Success! Slider updated');
        return redirect()->back();
    }

    public function delete_slider($slider_id)
    {
        $slider=slider::find($slider_id);
        ImageManager::delete($slider['slider_image']);
        $slider->delete();
        Toastr::success('Success! Deleted');
        return redirect()->back();
    }
}
