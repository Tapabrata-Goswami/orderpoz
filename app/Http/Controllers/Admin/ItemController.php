<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\menu_item;
use App\Models\category;
use App\Models\restaurant_category;
use App\Models\restaurant;
use App\Models\item_add_on;
use App\CPU\ImageManager;

class ItemController extends Controller
{
    public function item_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $item = restaurant_category::leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('menu_title', 'like', "%{$value}%")->orWhere('menu_price', 'like', "%{$value}%")->orWhere('restaurant_name', 'like', "%{$value}%");
                }
            })->orderBy('restaurant_cat_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $item = restaurant_category::leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->orderBy('restaurant_cat_id', 'desc');
        }
        if(session()->has('item_filter'))
        {
            $request = json_decode(session('item_filter'));
        }
        $item = $item->when(isset($request->restaurant_id)&&isset($request->cat_id)&&$request->restaurant_id!=null&&$request->cat_id!=null, function($query)use($request){
            return $query->where('restaurant_categories.restaurant_id',$request->restaurant_id)->where('restaurant_categories.cat_id',$request->cat_id);
        })->select('restaurant_categories.*','categories.cat_name','restaurants.restaurant_name')->paginate(config('default_pagination'))->appends($query_param);

        $restaurant = restaurant::orderBy('restaurant_name', 'ASC')->get();
        $category = category::where('cat_status',1)->orderBy('cat_name', 'desc')->get();

        $restaurant_id =isset($request->restaurant_id)?$request->restaurant_id:null;
        $cat_id =isset($request->cat_id)?$request->cat_id:null;

        return view('Admin.item', compact('item','search','category','restaurant','restaurant_id','cat_id'));
    }

    public function insert_item(Request $request)
    {
        $data1 = new menu_item();
        $data1->menu_title = $request->menu_title;
        $data1->menu_price = $request->menu_price;
        $data1->is_veg = $request->is_veg;
        $data1->cat_id = $request->cat_id;
        $data1->menu_description = $request->menu_description ? $request->menu_description : 'N/A';
        $data1->menu_image = ImageManager::upload('modal/', 'png', $request->file('image'));
        $data1->save();

        $data = new restaurant_category();
        $data->menu_id = $data1->menu_id;
        $data->restaurant_id = $request->restaurant_id;
        $data->menu_title = $request->menu_title;
        $data->menu_price = $request->menu_price;
        $data->is_veg = $request->is_veg;
        $data->cat_id = $request->cat_id;
        $data->menu_description = $request->menu_description ? $request->menu_description : 'N/A';
        $data->menu_image = $data1->menu_image;
        $data->save();

        Toastr::success('Success! Item Inserted');
        return redirect()->back();
    }

    public function update_item_status($restaurant_cat_id,$rest_menu_status)
    {
        $data = restaurant_category::find($restaurant_cat_id);
        $data->rest_menu_status=$rest_menu_status;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }


    public function update_item(Request $request)
    {
        $data = restaurant_category::find($request->restaurant_cat_id);
        if ($request->has('image')) {
            $data->menu_image = ImageManager::update('modal/', $data['menu_image'], 'png', $request->file('image'));
         }
         $data->restaurant_id = $request->restaurant_id;
         $data->menu_title = $request->menu_title;
         $data->menu_price = $request->menu_price;
         $data->is_veg = $request->is_veg;
         $data->cat_id = $request->cat_id;
         $data->menu_description = $request->menu_description ? $request->menu_description : 'N/A';
        $data->save();

        Toastr::success('Success! Item updated');
        return redirect()->back();
    }

    public function get_cat($restaurant_id)
    {
        $data['cat']=category::where('cat_status',1)->whereIn('restaurant_id',[0,$restaurant_id])->orderby('cat_id','DESC')->get(["cat_id","cat_name"]);
        return response()->json($data);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required',
            'cat_id' => 'required',
        ]);
        session()->put('item_filter', json_encode($request->all()));
        return back();
    }

    public function filter_reset(Request $request)
    {
        session()->forget('item_filter');
        return back();
    }

    public function insert_addon(Request $request)
    {
        $data1 = new item_add_on();
        $data1->add_on_name = $request->add_on_name;
        $data1->menu_id = $request->restaurant_cat_id;
        $data1->save();

        Toastr::success('Success! Item Add-on Inserted');
        return redirect()->back();
    }

    public function addon_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $item = item_add_on::leftjoin('restaurant_categories','restaurant_categories.restaurant_cat_id','item_add_ons.menu_id')->leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('item_add_ons.menu_id',$request->restaurant_cat_id)->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('menu_title', 'like', "%{$value}%")->orWhere('cat_name', 'like', "%{$value}%")->orWhere('add_on_name', 'like', "%{$value}%")->orWhere('restaurant_name', 'like', "%{$value}%");
                }
            })->orderBy('item_add_ons.add_on_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $item = item_add_on::leftjoin('restaurant_categories','restaurant_categories.restaurant_cat_id','item_add_ons.menu_id')->leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('item_add_ons.menu_id',$request->restaurant_cat_id)->orderBy('item_add_ons.add_on_id', 'desc');
        }
        $item = $item->select('item_add_ons.*','restaurant_categories.menu_title','categories.cat_name','restaurants.restaurant_name')->paginate(config('default_pagination'))->appends($query_param);

        $restaurant_cat_id = $request->restaurant_cat_id;
        
        return view('Admin.item-addon-list', compact('item','search','restaurant_cat_id'));
    }

    public function delete_addon($add_on_id)
    {
        $item_add_ons=item_add_on::find($add_on_id);
        $item_add_ons->delete();
        Toastr::success('Success! Deleted');
        return redirect()->back();
    }
}
