<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\restaurant;
use App\Models\category;
use App\Models\restaurant_category;
use App\Models\restaurant_outlet;
use App\Models\restaurant_gallery;
use App\Models\restaurant_review;
use App\Models\restaurant_time_slot;
use App\Models\local_notification_restaurant;
use App\Models\cart_item;
use App\Models\item_add_on;
use App\Models\book_table;
use App\CPU\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function category_list()
    {
        $category = category::where('is_show',1)->orderby('cat_id','ASC')->get();
        if($category->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>'Not','message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$category,'message'=>'List fetched'],200);
        }
    }

    public function near_restaurant_list(Request $request)
    {
        // $restaurant=restaurant::select("restaurants.*", \DB::raw("6371 * acos(cos(radians(" . auth()->user()->gps_lat . ")) * cos(radians(restaurants.restaurant_gps_lat)) * cos(radians(restaurants.restaurant_gps_lng) - radians(" . auth()->user()->gps_lng . ")) + sin(radians(" .auth()->user()->gps_lat. ")) * sin(radians(restaurants.restaurant_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurants.restaurant_status','1')->orderby('distance','ASC')->get();

        $restaurant=restaurant_outlet::leftjoin('restaurants','restaurants.restaurant_id','restaurant_outlets.restaurant_id')->select("restaurants.restaurant_id","restaurants.restaurant_name","restaurants.restaurant_mobile","restaurants.restaurant_email","restaurants.restaurant_image","restaurants.total_rating","restaurants.restaurant_about","restaurants.shipping_charge","restaurants.restaurant_status", \DB::raw("6371 * acos(cos(radians(" . $request->gps_lat . ")) * cos(radians(restaurant_outlets.outlet_gps_lat)) * cos(radians(restaurant_outlets.outlet_gps_lng) - radians(" . $request->gps_lng . ")) + sin(radians(" .$request->gps_lat. ")) * sin(radians(restaurant_outlets.outlet_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurants.restaurant_status','1')->groupby('restaurants.restaurant_id')->orderby('distance','ASC')->get();

        foreach($restaurant as $res)
        {
            $out = restaurant_outlet::select("restaurant_outlets.*", \DB::raw("6371 * acos(cos(radians(" . $request->gps_lat . ")) * cos(radians(restaurant_outlets.outlet_gps_lat)) * cos(radians(restaurant_outlets.outlet_gps_lng) - radians(" . $request->gps_lng . ")) + sin(radians(" .$request->gps_lat. ")) * sin(radians(restaurant_outlets.outlet_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurant_outlets.outlet_status','1')->where('restaurant_outlets.restaurant_id',$res->restaurant_id)->orderby('distance','ASC')->first();

            $res['restaurant_gps_address']=$out['outlet_gps_address'];
            $res['restaurant_gps_lat']=$out['outlet_gps_lat'];
            $res['restaurant_gps_lng']=$out['outlet_gps_lng'];
            $res['restaurant_state']=$out['outlet_state'];
            $res['restaurant_city']=$out['outlet_city'];
            $res['restaurant_area']=$out['outlet_area'];
            $res['outlet_id']=$out['outlet_id'];
            $res['distance']=number_format($out['distance'], 2, '.', ',');

            $day = Carbon::today()->format('l');

            if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->exists()) 
            {
                if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->exists()) 
                {
                    if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->where('is_close',1)->exists()) 
                    {
                        $time = restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->first();
                        $res['restaurant_from_time']=$time['from_time'];
                        $res['restaurant_to_time']=$time['to_time'];

                        if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
                        {
                            $res['is_open']=1;
                        }
                        else
                        {
                            $res['is_open']=0;
                        }
                    }
                    else
                    {
                        $res['restaurant_from_time']='00:01:00';
                        $res['restaurant_to_time']='00:02:00';
                        $res['is_open']=0;
                    }
                    
                }
                else
                {
                    $res['restaurant_from_time']='00:00:00';
                    $res['restaurant_to_time']='23:59:59';
                    $res['is_open']=1;
                }
            }
            else
            {
                $res['restaurant_from_time']='00:00:00';
                $res['restaurant_to_time']='23:59:59';
                $res['is_open']=1;
            }
        }
        
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant fetched'],200);
        }
    }

    public function catwise_restaurant_list(Request $request)
    {
        // $restaurant=restaurant_category::leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->select("restaurants.*", \DB::raw("6371 * acos(cos(radians(" . auth()->user()->gps_lat . ")) * cos(radians(restaurants.restaurant_gps_lat)) * cos(radians(restaurants.restaurant_gps_lng) - radians(" . auth()->user()->gps_lng . ")) + sin(radians(" .auth()->user()->gps_lat. ")) * sin(radians(restaurants.restaurant_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurants.restaurant_status','1')->where('restaurant_categories.cat_id',$cat_id)->groupby('restaurant_categories.restaurant_id')->orderby('distance','ASC')->get();

        $restaurant=restaurant_outlet::leftjoin('restaurants','restaurants.restaurant_id','restaurant_outlets.restaurant_id')->leftjoin('restaurant_categories','restaurant_categories.restaurant_id','restaurant_outlets.restaurant_id')->select("restaurants.restaurant_id","restaurants.restaurant_name","restaurants.restaurant_mobile","restaurants.restaurant_email","restaurants.restaurant_image","restaurants.total_rating","restaurants.restaurant_about","restaurants.shipping_charge","restaurants.restaurant_status", \DB::raw("6371 * acos(cos(radians(" . $request->gps_lat . ")) * cos(radians(restaurant_outlets.outlet_gps_lat)) * cos(radians(restaurant_outlets.outlet_gps_lng) - radians(" . $request->gps_lng . ")) + sin(radians(" .$request->gps_lat. ")) * sin(radians(restaurant_outlets.outlet_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurants.restaurant_status','1')->where('restaurant_categories.cat_id',$request->cat_id)->groupby('restaurant_categories.restaurant_id')->orderby('distance','ASC')->get();

        foreach($restaurant as $res)
        {
            $out = restaurant_outlet::select("restaurant_outlets.*", \DB::raw("6371 * acos(cos(radians(" . $request->gps_lat . ")) * cos(radians(restaurant_outlets.outlet_gps_lat)) * cos(radians(restaurant_outlets.outlet_gps_lng) - radians(" . $request->gps_lng . ")) + sin(radians(" .$request->gps_lat. ")) * sin(radians(restaurant_outlets.outlet_gps_lat))) AS distance"))->having('distance', '<=', 20)->where('restaurant_outlets.outlet_status','1')->where('restaurant_outlets.restaurant_id',$res->restaurant_id)->orderby('distance','ASC')->first();

            $res['restaurant_gps_address']=$out['outlet_gps_address'];
            $res['restaurant_gps_lat']=$out['outlet_gps_lat'];
            $res['restaurant_gps_lng']=$out['outlet_gps_lng'];
            $res['restaurant_state']=$out['outlet_state'];
            $res['restaurant_city']=$out['outlet_city'];
            $res['restaurant_area']=$out['outlet_area'];
            $res['outlet_id']=$out['outlet_id'];
            $res['distance']=number_format($out['distance'], 2, '.', ',');

            $day = Carbon::today()->format('l');

            if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->exists()) 
            {
                if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->exists()) 
                {
                    if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->where('is_close',1)->exists()) 
                    {
                        $time = restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day)->first();
                        $res['restaurant_from_time']=$time['from_time'];
                        $res['restaurant_to_time']=$time['to_time'];

                        if (restaurant_time_slot::where('restaurant_id',$res->restaurant_id)->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
                        {
                            $res['is_open']=1;
                        }
                        else
                        {
                            $res['is_open']=0;
                        }
                    }
                    else
                    {
                        $res['restaurant_from_time']='00:01:00';
                        $res['restaurant_to_time']='00:02:00';
                        $res['is_open']=0;
                    }
                    
                }
                else
                {
                    $res['restaurant_from_time']='00:00:00';
                    $res['restaurant_to_time']='23:59:59';
                    $res['is_open']=1;
                }
            }
            else
            {
                $res['restaurant_from_time']='00:00:00';
                $res['restaurant_to_time']='23:59:59';
                $res['is_open']=1;
            }
        }
        
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant fetched'],200);
        }
    }

    public function restaurant_detail($restaurant_id,$outlet_id)
    {
        $restaurant=restaurant::select("restaurants.restaurant_id","restaurants.restaurant_name","restaurants.restaurant_mobile","restaurants.restaurant_email","restaurants.restaurant_image","restaurants.total_rating","restaurants.restaurant_about","restaurants.shipping_charge","restaurants.is_outlet","restaurants.book_table","restaurants.restaurant_contact_person","restaurants.restaurant_phone")->where('restaurants.restaurant_status',1)->where('restaurants.restaurant_id',$restaurant_id)->first();
        $outlet=restaurant_outlet::where('outlet_id',$outlet_id)->first();

        $restaurant['restaurant_gps_address'] = $outlet->outlet_gps_address;
        $restaurant['restaurant_gps_lat'] = $outlet->outlet_gps_lat;
        $restaurant['restaurant_gps_lng'] = $outlet->outlet_gps_lng;
        $restaurant['restaurant_state'] = $outlet->outlet_state;
        $restaurant['restaurant_city'] = $outlet->outlet_city;
        $restaurant['restaurant_area'] = $outlet->outlet_area;

        $day = Carbon::today()->format('l');

            if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->exists()) 
            {
                if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day)->exists()) 
                {
                    if (restaurant_time_slot::where('restaurant_id',$restaurant->restaurant_id)->where('day',$day)->where('is_close',1)->exists()) 
                    {
                        $time = restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day)->first();
                        $restaurant['restaurant_from_time']=$time['from_time'];
                        $restaurant['restaurant_to_time']=$time['to_time'];

                        if (restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day',$day) ->where('from_time', '<=', date('H:i:s'))->where('to_time', '>=', date('H:i:s'))->exists()) 
                        {
                            $restaurant['is_open']=1;
                        }
                        else
                        {
                            $restaurant['is_open']=0;
                        }
                    }
                    else
                    {
                        $restaurant['restaurant_from_time']='00:01:00';
                        $restaurant['restaurant_to_time']='00:02:00';
                        $restaurant['is_open']=0;
                    }

                }
                else
                {
                    $restaurant['restaurant_from_time']='00:00:00';
                    $restaurant['restaurant_to_time']='23:59:59';
                    $restaurant['is_open']=1;
                }
            }
            else
            {
                $restaurant['restaurant_from_time']='00:00:00';
                $restaurant['restaurant_to_time']='23:59:59';
                $restaurant['is_open']=1;
            }

            $restaurant['open_time']=restaurant_time_slot::where('restaurant_id',$restaurant_id)->get();
        
        if($restaurant)
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant fetched'],200);
        }
        else
        {
            return response()->json(['success' => 'false','data'=>'N/A','message'=>'Restaurant Not Found'],200);
        }
    }

    public function restaurant_gallery($restaurant_id)
    {
        $restaurant=restaurant_gallery::where('restaurant_id',$restaurant_id)->get();
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant gallery not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant gallery fetched'],200);
        }
    }

    public function restaurant_menu_list($restaurant_id,$user_id)
    {
        $restaurant=restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->leftjoin('restaurants','restaurants.restaurant_id','restaurant_categories.restaurant_id')->leftjoin('countries','countries.country_id','restaurants.country_id')->select('restaurant_categories.*','countries.*','categories.cat_name','categories.cat_image')->where('restaurant_categories.restaurant_id',$restaurant_id)->where('restaurant_categories.rest_menu_status',1)->orderby('restaurant_categories.restaurant_cat_id')->get();
        
        foreach($restaurant as $res)
        {
            if (cart_item::where('user_id',$user_id)->where('restaurant_cat_id',$res['restaurant_cat_id'])->exists()) 
            {
               $cart_item = cart_item::where('user_id',$user_id)->where('restaurant_cat_id',$res['restaurant_cat_id'])->first();
                $res['qty'] = $cart_item->qty;
                $res['cart_id'] = $cart_item->cart_id;
            }
            else
            {
                $res['qty'] = 0;
                $res['cart_id'] = 0;
            }

            if (item_add_on::where('menu_id',$res['restaurant_cat_id'])->exists())
            {
                $res['is_add_no'] = 1;
            }
            else
            {
                $res['is_add_no'] = 0;
            }
        }
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant menu not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant menu fetched'],200);
        }
    }

    public function restaurant_review_list($restaurant_id)
    {
        $restaurant=restaurant_review::leftjoin('users','users.id','restaurant_reviews.user_id')->select('restaurant_reviews.*','users.name')->where('restaurant_reviews.restaurant_id',$restaurant_id)->get();
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant review not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant review fetched'],200);
        }
    }

    public function restaurant_outlet_list($restaurant_id)
    {
        $restaurant=restaurant_outlet::where('outlet_status',1)->where('restaurant_id',$restaurant_id)->get();
        if($restaurant->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$restaurant,'message'=>'Restaurant outlet not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$restaurant,'message'=>'Restaurant outlet fetched'],200);
        }
    }

    public function add_ons_list($menu_id)
    {
        $add_on=item_add_on::where('menu_id',$menu_id)->get();
        if($add_on->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$add_on,'message'=>'Add ons not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$add_on,'message'=>'Add ons fetched'],200);
        }
    }

    public function add_book_table(Request $request)
    {
        $data = $request->all();

        $ins1=array(
            'firstname'=>$data['firstname'] ? $data['firstname'] : 'N/A',
            'lastname'=>$data['lastname'] ? $data['lastname'] : 'N/A',
            'email'=>$data['email'] ? $data['email'] : 'N/A',
            'user_id'=>auth()->user()->id,
            'phone'=>$data['phone'] ? $data['phone'] : 'N/A',
            'date_time'=>$data['date_time'] ? $data['date_time'] : '0',
            'person'=>$data['person'] ? $data['person'] : '0',
            'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : 'N/A',
        );

            $book_table = book_table::create($ins1);
            
            if($book_table)
            {
                if (restaurant::where('restaurant_id',$data['restaurant_id'])->exists()) 
                {
                    $restaurant = restaurant::where('restaurant_id',$data['restaurant_id'])->first();
                    $data = [
                        'title' => 'Orderpoz Restaurant',
                        'description' => 'Table booked by '.$data['firstname'].' on '.date('d M Y h:i A',strtotime($data['date_time'])),
                    ];
                    Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);
                }

                $ins2=array(
                    'noti_restaurant_id'=>$data['restaurant_id'],
                    'noti_type'=>'1',
                    'noti_msg'=>'Table booked by '.$data['firstname'].' on '.date('d M Y h:i A',strtotime($data['date_time'])),
                    'noti_status'=>'1',
                );
                $local_notification = local_notification_restaurant::create($ins2);

                return response()->json(['success' => 'true','data'=>$book_table,'message'=>'Table Booked'],200);
            }
            else
            {
                return response()->json(['success' => 'false','data'=>$book_table,'message'=>'Something went wrong'],200);
            }
    }

    public function book_table_list()
    {
        $book_table=book_table::leftjoin('restaurants','restaurants.restaurant_id','book_tables.restaurant_id')->select('book_tables.*','restaurants.restaurant_name','restaurants.restaurant_mobile','restaurants.restaurant_email','restaurants.restaurant_gps_address','restaurants.restaurant_gps_lat','restaurants.restaurant_gps_lng')->where('user_id',auth()->user()->id)->orderby('book_tables.book_table_id','desc')->get();
        if($book_table->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$book_table,'message'=>'Booked table not found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$book_table,'message'=>'Booked table fetched'],200);
        }
    }
}
