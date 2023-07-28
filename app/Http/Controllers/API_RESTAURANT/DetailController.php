<?php

namespace App\Http\Controllers\API_RESTAURANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CPU\Helpers;
use Illuminate\Support\Str;
use App\CPU\ImageManager;
use Illuminate\Support\Arr;
use Validator;
use App\Models\detail;
use App\Models\local_notification_restaurant;
use App\Models\restaurant_review;
use App\Models\state;
use App\Models\city;
use App\Models\area;
use App\Models\country;
use App\Models\restaurant_time_slot;

class DetailController extends Controller
{
    public function show(Request $request)
    {
        $detail = detail::first();
        return response()->json(['success' => 'true','data' => $detail,'message' => 'Details fetched.'], 200);
    }

    public function country_show()
    {
        $country = country::get();
        
        if($country->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$country,'message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$country,'message'=>'List fetched'],200);
        }
    }

    public function fileupload(Request $request)
    {
       $validator = Validator::make($request->all(),[ 
              'image' => 'required|image:jpeg,png,jpg',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 400);
            
        }
         
        $image=ImageManager::upload('modal/', 'png', $request->file('image'));
        return response()->json(['image' => $image], 200);
    }

    public function localnotishow(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $noti = local_notification_restaurant::where('noti_restaurant_id',$restaurant['restaurant_id'])->orderby('restaurant_noti_id','DESC')->get();
        if($noti->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>'Not','message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$noti,'message'=>'List fetched'],200);
        }
    }

    public function reviewshow(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $review = restaurant_review::leftjoin('users','users.id','restaurant_reviews.user_id')->where('restaurant_reviews.restaurant_id',$restaurant['restaurant_id'])->select('restaurant_reviews.*','users.name','users.image')->orderby('restaurant_reviews.review_id','DESC')->get();

        $avg_rate='0.0';
        if (restaurant_review::where('restaurant_id',$restaurant['restaurant_id'])->exists()) 
        {
            $avg_rate = restaurant_review::where('restaurant_id',$restaurant['restaurant_id'])->avg('restaurant_rate');
        }

        $total_review = restaurant_review::where('restaurant_id',$restaurant['restaurant_id'])->count();

        if($review->isEmpty())
        {
            return response()->json(['success' => 'false','avg_rate' => $avg_rate,'total_review' => $total_review,'data'=>'Not','message'=>'List Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','avg_rate' => $avg_rate,'total_review' => $total_review,'data'=>$review,'message'=>'List fetched'],200);
        }
    }

    public function stateshow()
    {
        $state = state::get();
        return response()->json(['success' => 'true','data' => $state,'message' => 'States fetched.'], 200);
    }

    public function cityshow($state_id)
    {
        $city = city::where('state_id',$state_id)->get();
        return response()->json(['success' => 'true','data' => $city,'message' => 'City fetched.'], 200);
    }

    public function areashow($state_id,$city_id)
    {
        $area = area::where('state_id',$state_id)->where('city_id',$city_id)->get();
        return response()->json(['success' => 'true','data' => $area,'message' => 'Area fetched.'], 200);
    }

    public function timeslot_add(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $input = $request->all();
        $day = explode(',', $input['day']);
        $from_time = explode(',', $input['from_time']);
        $to_time = explode(',', $input['to_time']);

        if(restaurant_time_slot::where('restaurant_id',$restaurant['restaurant_id'])->exists())
        {
            for($i=0;$i<count($day);$i++)
            {
                $ins=array(
                    'day'=>$day[$i],
                    'from_time'=>$from_time[$i],
                    'to_time'=>$to_time[$i],
                    'restaurant_id'=>$restaurant['restaurant_id'],
                );

                restaurant_time_slot::where('restaurant_id',$restaurant['restaurant_id'])->where('day',$day[$i])->update(array('from_time'=>$from_time[$i],'to_time'=>$to_time[$i]));
            }
        }
        else
        {
            for($i=0;$i<count($day);$i++)
            {
                $ins=array(
                    'day'=>$day[$i],
                    'from_time'=>$from_time[$i],
                    'to_time'=>$to_time[$i],
                    'restaurant_id'=>$restaurant['restaurant_id'],
                );
                $restaurant_time_slot = restaurant_time_slot::create($ins);
            }
        }
        
        return response()->json(['success' => 'true','data' => 'N/A','message' => 'Restaurant timeslot created.'], 200);
    }

    public function timeslot_list(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $time_slot = restaurant_time_slot::where('restaurant_id',$restaurant['restaurant_id'])->get();

        if($time_slot->isEmpty())
        {
            return response()->json(['success' => 'false','data'=>$time_slot,'message'=>'Time slot Not Found'],200);
        }
        else
        {
            return response()->json(['success' => 'true','data'=>$time_slot,'message'=>'Time slot fetched'],200);
        }
            
    }

    public function close_restaurant(Request $request)
    {
        $data = Helpers::get_restaurant_by_token($request);

        if ($data['success'] == 1) {
            $restaurant = $data['data'];
        } else {
            return response()->json(['success' => 'false','data'=>'Unauthorised','message'=>'Unauthorised'],200);
        }

        $input = $request->all();

        if($request->is_close==0)
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
                'is_close'=>1,
            );
        }
        restaurant_time_slot::where('time_slot_id',$request['time_slot_id'])->update($ins);
        
        return response()->json(['success' => 'true','data' => 'N/A','message' => 'Restaurant timeslot created.'], 200);

        
    }
}
