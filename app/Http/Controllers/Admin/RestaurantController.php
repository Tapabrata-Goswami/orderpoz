<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\restaurant;
use App\Models\restaurant_category;
use App\Models\User;
use App\Models\restaurant_gallery;
use App\Models\restaurant_outlet;
use App\Models\category;
use App\Models\restaurant_review;
use App\Models\menu_item;
use App\Models\restaurant_time_slot;
use App\Models\book_table;
use App\Models\country;
use App\CPU\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use App\CPU\Helpers;
use Validator;

class RestaurantController extends Controller
{
    public function add_restaurant()
    {
        $category = category::where('cat_status',1)->orderBy('cat_name','ASC')->get();
        $country = country::orderBy('country_name','ASC')->get();
        $imgcnt=6;
        return view('Admin/restaurant-add',compact('category','imgcnt','country'));
    }

    public function insert_restaurant(Request $request)
    {
        $data=$request->input();

        $ins=array(
            'restaurant_name'=>$data['restaurant_name'] ? $data['restaurant_name'] : 'N/A',
            'restaurant_mobile'=>$data['restaurant_mobile'] ? $data['restaurant_mobile'] : 'N/A',
            'restaurant_email'=>$data['restaurant_email'] ? $data['restaurant_email'] : 'N/A',
            'restaurant_gps_address'=>$data['restaurant_gps_address'] ? $data['restaurant_gps_address'] : 'N/A',
            'restaurant_gps_lat'=>$data['restaurant_gps_lat'] ? $data['restaurant_gps_lat'] : 'N/A',
            'restaurant_gps_lng'=>$data['restaurant_gps_lng'] ? $data['restaurant_gps_lng'] : 'N/A',
            'restaurant_state'=>$data['restaurant_state'] ? $data['restaurant_state'] : 'N/A',
            'restaurant_city'=>$data['restaurant_city'] ? $data['restaurant_city'] : 'N/A',
            'restaurant_area'=>$data['restaurant_area'] ? $data['restaurant_area'] : 'N/A',
            'country_id'=>$data['country_id'] ? $data['country_id'] : '1',
            'shipping_charge'=>$data['shipping_charge'] ? $data['shipping_charge'] : '0',
            'license_no'=>$data['license_no'] ? $data['license_no'] : 'N/A',
            'aadhar_no'=>$data['aadhar_no'] ? $data['aadhar_no'] : 'N/A',
            'pancard_no'=>$data['pancard_no'] ? $data['pancard_no'] : 'N/A',
            'voter_card_no'=>$data['voter_card_no'] ? $data['voter_card_no'] : 'N/A',
            'restaurant_about'=>$data['restaurant_about'] ? $data['restaurant_about'] : 'N/A',
            'restaurant_contact_person'=>$data['restaurant_contact_person'] ? $data['restaurant_contact_person'] : 'N/A',
            'restaurant_phone'=>$data['restaurant_phone'] ? $data['restaurant_phone'] : 'N/A',
            'delivery_type'=>$data['delivery_type'] ? $data['delivery_type'] : 'N/A',
            'secret_key'=>$data['secret_key'] ? $data['secret_key'] : 'N/A',
            'publish_key'=>$data['publish_key'] ? $data['publish_key'] : 'N/A',
            'restaurant_device_id'=>'N/A',
            'pancard_back_image'=>'N/A',
        );

        if(!empty($data['restaurant_id']))
        {
            if(restaurant::where('restaurant_mobile',$data['restaurant_mobile'])->where('restaurant_id','!=',$data['restaurant_id'])->exists())
            {
                Toastr::warning('Warning! Restaurant mobile no. is already exist');
                return back();
            }
            else if(restaurant::where('restaurant_email',$data['restaurant_email'])->where('restaurant_id','!=',$data['restaurant_id'])->exists())
            {
                Toastr::warning('Warning! Restaurant email id is already exist');
                return back();
            }
            else
            {
                $restaurant = restaurant::find($request->restaurant_id);
                if ($request->has('restaurant_image')) {
                    $ins['restaurant_image'] = ImageManager::update('modal/', $restaurant['restaurant_image'], 'png', $request->file('restaurant_image'));
                }

                if ($request->has('aadhar_front_image')) {
                    $ins['aadhar_front_image'] = ImageManager::update('modal/', $restaurant['aadhar_front_image'], 'png', $request->file('aadhar_front_image'));
                }

                if ($request->has('aadhar_back_image')) {
                    $ins['aadhar_back_image'] = ImageManager::update('modal/', $restaurant['aadhar_back_image'], 'png', $request->file('aadhar_back_image'));
                }

                if ($request->has('pancard_front_image')) {
                    $ins['pancard_front_image'] = ImageManager::update('modal/', $restaurant['pancard_front_image'], 'png', $request->file('pancard_front_image'));
                }

                if ($request->has('voter_front_image')) {
                    $ins['voter_front_image'] = ImageManager::update('modal/', $restaurant['voter_front_image'], 'png', $request->file('voter_front_image'));
                }

                if ($request->has('voter_back_image')) {
                    $ins['voter_back_image'] = ImageManager::update('modal/', $restaurant['voter_back_image'], 'png', $request->file('voter_back_image'));
                }

                $res_name = strtolower($data['restaurant_name']);
                $restaurant_name_code = str_replace("'", '', $res_name);
                $ins['restaurant_name_code'] = str_replace(' ', '-', $restaurant_name_code);

                if ($request['password'] == null) {
                    $pass = $restaurant['password'];
                } 
                else 
                {
                    $pass = bcrypt($request['password']);
                }
                $ins['password']=$pass;

                $select_kyc = '';
                if (empty($data['select_kyc'])) 
                {
                    $select_kyc='N/A';
                }
                else
                {
                    for($j=0;$j<count($data['select_kyc']);$j++)
                    {
                        if($j == 0)
                        {
                            $select_kyc = $data['select_kyc'][$j];
                        }
                        else
                        {
                            $select_kyc .= ','.$data['select_kyc'][$j];
                        }
                        
                    }
                }

                $ins['select_kyc']=$select_kyc;

                restaurant::where('restaurant_id',$data['restaurant_id'])->update($ins);

                $ins1=array(
                    'outlet_gps_address'=>$data['restaurant_gps_address'] ? $data['restaurant_gps_address'] : 'N/A',
                    'outlet_gps_lat'=>$data['restaurant_gps_lat'] ? $data['restaurant_gps_lat'] : 'N/A',
                    'outlet_gps_lng'=>$data['restaurant_gps_lng'] ? $data['restaurant_gps_lng'] : 'N/A',
                    'outlet_state'=>$data['restaurant_state'] ? $data['restaurant_state'] : 'N/A',
                    'outlet_city'=>$data['restaurant_city'] ? $data['restaurant_city'] : 'N/A',
                    'outlet_area'=>$data['restaurant_area'] ? $data['restaurant_area'] : 'N/A',
                    'restaurant_id'=>$data['restaurant_id'],
                );
                restaurant_outlet::where('restaurant_id',$data['restaurant_id'])->where('is_main',1)->update($ins1);
                
                if (!empty($request->file('gallery_image'))) {

                    foreach ($request->gallery_image as $img) {
                        $data1 = new restaurant_gallery();
                        $data1->restaurant_id = $data['restaurant_id'];
                        $data1->gallery_image = ImageManager::upload('modal/', 'png', $img);
                        $data1->save();
                    }
                }

                Toastr::success('Success! Restaurant Updated');
                return redirect()->route('panel.Restaurant.list');
            }
        }
        else
        {
            if(restaurant::where('restaurant_mobile',$data['restaurant_mobile'])->exists())
            {
                Toastr::warning('Warning! Restaurant is already exist');
                return back();
            }
            else
            {
                $ins['restaurant_image']=ImageManager::upload('modal/', 'png', $request->file('restaurant_image'));
                $ins['aadhar_front_image']=ImageManager::upload('modal/', 'png', $request->file('aadhar_front_image'));
                $ins['aadhar_back_image']=ImageManager::upload('modal/', 'png', $request->file('aadhar_back_image'));
                $ins['pancard_front_image']=ImageManager::upload('modal/', 'png', $request->file('pancard_front_image'));
                $ins['pancard_back_image']=ImageManager::upload('modal/', 'png', $request->file('pancard_back_image'));
                $ins['voter_front_image']=ImageManager::upload('modal/', 'png', $request->file('voter_front_image'));
                $ins['voter_back_image']=ImageManager::upload('modal/', 'png', $request->file('voter_back_image'));

                $res_name = strtolower($data['restaurant_name']);
                $restaurant_name_code = str_replace("'", '', $res_name);
                $ins['restaurant_name_code'] = str_replace(' ', '-', $restaurant_name_code);

                $ins['password']=bcrypt($data['password']);

                $select_kyc = '';
                if (empty($data['select_kyc'])) 
                {
                    $select_kyc='N/A';
                }
                else
                {
                    for($j=0;$j<count($data['select_kyc']);$j++)
                    {
                        if($j == 0)
                        {
                            $select_kyc = $data['select_kyc'][$j];
                        }
                        else
                        {
                            $select_kyc .= ','.$data['select_kyc'][$j];
                        }
                        
                    }
                }

                $ins['select_kyc']=$select_kyc;

                $restaurant_id=restaurant::create($ins)->restaurant_id;

                $ins1=array(
                    'outlet_gps_address'=>$data['restaurant_gps_address'] ? $data['restaurant_gps_address'] : 'N/A',
                    'outlet_gps_lat'=>$data['restaurant_gps_lat'] ? $data['restaurant_gps_lat'] : 'N/A',
                    'outlet_gps_lng'=>$data['restaurant_gps_lng'] ? $data['restaurant_gps_lng'] : 'N/A',
                    'outlet_state'=>$data['restaurant_state'] ? $data['restaurant_state'] : 'N/A',
                    'outlet_city'=>$data['restaurant_city'] ? $data['restaurant_city'] : 'N/A',
                    'outlet_area'=>$data['restaurant_area'] ? $data['restaurant_area'] : 'N/A',
                    'is_main'=>1,
                    'restaurant_id'=>$restaurant_id,
                );
                $restaurant_outlet = restaurant_outlet::create($ins1);

                if (!empty($request->file('gallery_image'))) {
                    foreach ($request->gallery_image as $img) {
                        $data1 = new restaurant_gallery();
                        $data1->restaurant_id = $restaurant_id;
                        $data1->gallery_image = ImageManager::upload('modal/', 'png', $img);
                        $data1->save();
                    }
                }

                for($i=0;$i<7;$i++)
                {
                    if ($i==0) 
                    {
                        $day='Sunday';
                    }
                    if ($i==1) 
                    {
                        $day='Monday';
                    }
                    if ($i==2) 
                    {
                        $day='Tuesday';
                    }
                    if ($i==3) 
                    {
                        $day='Wednesday';
                    }
                    if ($i==4) 
                    {
                        $day='Thursday';
                    }
                    if ($i==5) 
                    {
                        $day='Friday';
                    }
                    if ($i==6) 
                    {
                        $day='Saturday';
                    }
                    $ins2=array(
                        'day'=>$day,
                        'from_time'=>'00:00:00',
                        'to_time'=>'23:59:59',
                        'restaurant_id'=>$restaurant_id,
                    );

                    $restaurant_time_slot = restaurant_time_slot::create($ins2);
                }

                Toastr::success('Success! Restaurant Inserted');
                return back();
            }
        }
    }

    public function restaurant_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $restaurant = restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('restaurants.restaurant_name', 'like', "%{$value}%")->orWhere('restaurants.restaurant_mobile', 'like', "%{$value}%")->orwhere('restaurants.restaurant_email', 'like', "%{$value}%")->orwhere('countries.country_name', 'like', "%{$value}%");
                }
            })->orderBy('restaurants.restaurant_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $restaurant = restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->orderBy('restaurants.restaurant_id', 'desc');
        }
        $restaurant = $restaurant->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.restaurant-list', compact('restaurant','search'));
    }

    public function edit_restaurant($restaurant_id)
    {
        $category = category::where('cat_status',1)->orderBy('cat_name','ASC')->get();
        $restaurant_category = restaurant_category::where('restaurant_id',$restaurant_id)->orderBy('restaurant_cat_id','DESC')->get();
        $restaurant = restaurant::where('restaurant_id',$restaurant_id)->orderBy('restaurant_id','DESC')->first();
        $restaurant_gallery = restaurant_gallery::where('restaurant_id',$restaurant_id)->orderBy('gallery_id','ASC')->get();
        $imgcnt = $restaurant_gallery->count();

        $country = country::orderBy('country_name','ASC')->get();

        $select_kyc=explode(',', $restaurant->select_kyc);

        return view('Admin/restaurant-add',compact('category','restaurant','restaurant_category','restaurant_gallery','imgcnt','country','select_kyc'));
    }

    public function remove_image(Request $request)
    {
        if (restaurant_gallery::where('restaurant_id',$request['restaurant_id'])->count()<2) 
        {
            Toastr::warning('Warning! You cannot delete all images!');
            return back();
        }
        else
        {
            $restaurant_gallery = restaurant_gallery::find($request['gallery_id']);
            ImageManager::delete($request['name']);
            $restaurant_gallery->delete();
            Toastr::success('Success! image removed successfully!');
            return back();
        }
    }

    public function update_restaurant_status($restaurant_id,$restaurant_status)
    {
        if(restaurant_category::where('restaurant_id',$restaurant_id)->exists())
        {
            $data = restaurant::find($restaurant_id);
            $data-> restaurant_status = $restaurant_status;
            $data -> save();
            if($restaurant_status==1)
            {
                $data1 = [
                    'title' => 'Orderpoz Restaurant',
                    'description' => $data->restaurant_name.' approved by admin',
                ];
            }
            else
            {
                $data1 = [
                    'title' => 'Orderpoz Restaurant',
                    'description' => $data->restaurant_name.' dis-approved by admin',
                ];
            }

            Helpers::send_to_device('restaurant',$data->restaurant_device_id,$data1);

            Toastr::success('Success! Status updated');
            return back();
        }
        else
        {
            Toastr::error('error! Please first add restaurant category items');
            return back();
        }
    }

    public function update_book_table_status($restaurant_id,$book_table)
    {
        $data = restaurant::find($restaurant_id);
        $data-> book_table = $book_table;
        $data -> save();
        if($book_table==1)
        {
            $data1 = [
                'title' => 'Orderpoz Restaurant',
                'description' => $data->restaurant_name.' book a table approved by admin',
            ];
        }
        else
        {
            $data1 = [
                'title' => 'Orderpoz Restaurant',
                'description' => $data->restaurant_name.' book a table dis-approved by admin',
            ];
        }

        Helpers::send_to_device('restaurant',$data->restaurant_device_id,$data1);

        Toastr::success('Success! Status updated');
        return back();
    }

    public function update_multiple_outlet_status($restaurant_id,$is_outlet)
    {
        $data = restaurant::find($restaurant_id);
        $data-> is_outlet = $is_outlet;
        $data -> save();
        if($is_outlet==1)
        {
            $data1 = [
                'title' => 'Orderpoz Restaurant',
                'description' => $data->restaurant_name.' multiple outlets approved by admin',
            ];
        }
        else
        {
            $data1 = [
                'title' => 'Orderpoz Restaurant',
                'description' => $data->restaurant_name.' multiple outlets dis-approved by admin',
            ];
        }

        Helpers::send_to_device('restaurant',$data->restaurant_device_id,$data1);

        Toastr::success('Success! Status updated');
        return back();
    }

    public function restaurant_detail(Request $request,$restaurant_id,$tab = null)
    {
        $restaurant = restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurants.restaurant_id',$restaurant_id)->orderBy('restaurants.restaurant_id', 'desc')->first();

        $restaurant_outlet = restaurant_outlet::where('restaurant_id',$restaurant_id)->orderBy('outlet_id', 'desc')->get();
        $restaurant_time_slot = restaurant_time_slot::where('restaurant_id',$restaurant_id)->orderBy('time_slot_id', 'ASC')->get();

        if ($tab == 'review') 
        {
            $review = restaurant_review::leftjoin('users','users.id','restaurant_reviews.user_id')->where('restaurant_id',$restaurant_id)->selectRaw("restaurant_reviews.*,users.name,users.mobile")->paginate(config('default_pagination'));

            return view('Admin.view.restaurant-review', compact('restaurant','restaurant_time_slot', 'review'));
        }
        if ($tab == 'outlet') 
        {
            $outlets = restaurant_outlet::where('restaurant_id',$restaurant_id)->paginate(config('default_pagination'));

            return view('Admin.view.restaurant-outlet', compact('restaurant','outlets','restaurant_time_slot'));
        }
        if ($tab == 'booktable') 
        {
            $booktable = book_table::leftjoin('users','users.id','book_tables.user_id')->where('restaurant_id',$restaurant_id)->paginate(config('default_pagination'));

            return view('Admin.view.booked-table', compact('restaurant','booktable','restaurant_time_slot'));
        }

        return view('Admin.restaurant-detail', compact('restaurant','restaurant_outlet','restaurant_time_slot'));
    }

    public function add_timeslot(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'from_time'=>'required',
            'to_time'=>'required|after:from_time',
            'time_slot_id'=>'required',
        ],[
            'to_time.after'=>'messages.End time must be after the start time'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $ins=array(
            'from_time'=>$request['from_time'],
            'to_time'=>$request['to_time'],
        );
        restaurant_time_slot::where('time_slot_id',$request['time_slot_id'])->update($ins);
        $restaurant_id=$request['restaurant_id'];

        return response()->json([
            'view' => view('Admin.view.restaurant-timeslot', compact('restaurant_id'))->render(),
        ]);
    }

    public function close_timeslot(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'time_slot_id'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        
        if(restaurant_time_slot::where('time_slot_id',$request['time_slot_id'])->where('is_close',1)->exists())
        {
            $ins=array(
                'from_time'=>'00:01:00',
                'to_time'=>'00:02:00',
                'is_close'=>0,
            );
        }
        else
        {
            $ins=array(
                'from_time'=>'00:01:00',
                'to_time'=>'00:02:00',
                'is_close'=>1,
            );
        }
        restaurant_time_slot::where('time_slot_id',$request['time_slot_id'])->update($ins);
        $restaurant_id=$request['restaurant_id'];

        return response()->json([
            'view' => view('Admin.view.restaurant-timeslot', compact('restaurant_id'))->render(),
        ]);
    }

    public function insert_outlet(Request $request)
    {
        $data=$request->input();

        $ins=array(
            'outlet_gps_address'=>$data['outlet_gps_address'] ? $data['outlet_gps_address'] : 'N/A',
            'outlet_gps_lat'=>$data['outlet_gps_lat'] ? $data['outlet_gps_lat'] : 'N/A',
            'outlet_gps_lng'=>$data['outlet_gps_lng'] ? $data['outlet_gps_lng'] : 'N/A',
            'outlet_area'=>$data['outlet_area'] ? $data['outlet_area'] : 'N/A',
            'outlet_city'=>$data['outlet_city'] ? $data['outlet_city'] : 'N/A',
            'outlet_state'=>$data['outlet_state'] ? $data['outlet_state'] : 'N/A',
            'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : 'N/A',
        );

            $restaurant_outlet=restaurant_outlet::create($ins);

            Toastr::success('Success! Outlet Inserted');
            return back();
    }

    public function update_outlet_status($outlet_id,$outlet_status)
    {
        $data = restaurant_outlet::find($outlet_id);
        $data-> outlet_status = $outlet_status;
        $data -> save();

        Toastr::success('Success! Status updated');
        return back();
    }
}
