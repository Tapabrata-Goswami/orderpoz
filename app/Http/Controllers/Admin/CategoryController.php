<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\category;
use App\Models\restaurant;
use App\CPU\ImageManager;

class CategoryController extends Controller
{
    public function category_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $categories = category::where('categories.restaurant_id',0)->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('cat_name', 'like', "%{$value}%");
                }
            })->orderBy('cat_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $categories = category::where('categories.restaurant_id',0)->orderBy('cat_id', 'desc');
        }
        $categories = $categories->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.category', compact('categories','search'));
    }

    public function insert_category(Request $request)
    {
        $data = new category();
        $data->cat_name = $request->cat_name;
        $data->cat_image = ImageManager::upload('modal/', 'png', $request->file('image'));
        $data->save();

        Toastr::success('Success! Category Inserted');
        return redirect()->back();
    }

    public function update_category_status($cat_id,$cat_status)
    {
        $data = category::find($cat_id);
        $data->cat_status=$cat_status;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }

    public function update_category_status_show($cat_id,$is_show)
    {
        $data = category::find($cat_id);
        $data->is_show=$is_show;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }

    public function update_category(Request $request)
    {
        $data = category::find($request->cat_id);
        if ($request->has('image')) {
            $data->cat_image = ImageManager::update('modal/', $data['cat_image'], 'png', $request->file('image'));
         }
        $data->cat_name = $request->cat_name;
        $data->save();

        Toastr::success('Success! Category updated');
        return redirect()->back();
    }

    public function rest_category_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $categories = category::leftjoin('restaurants','restaurants.restaurant_id','categories.restaurant_id')->where('categories.restaurant_id','!=',0)->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('categories.cat_name', 'like', "%{$value}%")->orWhere('restaurants.restaurant_name', 'like', "%{$value}%");
                }
            })->orderBy('categories.cat_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $categories = category::leftjoin('restaurants','restaurants.restaurant_id','categories.restaurant_id')->where('categories.restaurant_id','!=',0)->orderBy('categories.cat_id', 'desc');
        }
        $categories = $categories->select('categories.*','restaurants.restaurant_name')->paginate(config('default_pagination'))->appends($query_param);

        $restaurant = restaurant::orderBy('restaurant_name', 'ASC')->get();
        return view('Admin.restaurant-category', compact('categories','search','restaurant'));
    }

    public function insert_rest_category(Request $request)
    {
        if (category::where('restaurant_id',$request->restaurant_id)->where('cat_name',$request->cat_name)->exists()) 
        {
            Toastr::success('Success! Category already exists');
            return redirect()->back();
        }
        else
        {
            $data = new category();
            $data->cat_name = $request->cat_name;
            $data->restaurant_id = $request->restaurant_id;
            $data->cat_image = ImageManager::upload('modal/', 'png', $request->file('image'));
            $data->save();

            Toastr::success('Success! Category Inserted');
            return redirect()->back();
        }
    }

    public function update_rest_category(Request $request)
    {
        $data = category::find($request->cat_id);
        if ($request->has('image')) {
            $data->cat_image = ImageManager::update('modal/', $data['cat_image'], 'png', $request->file('image'));
         }
        $data->cat_name = $request->cat_name;
        $data->restaurant_id = $request->restaurant_id;
        $data->save();

        Toastr::success('Success! Category updated');
        return redirect()->back();
    }
}
