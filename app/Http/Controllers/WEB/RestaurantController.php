<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\restaurant;
use App\Models\restaurant_outlet;
use App\Models\restaurant_gallery;
use App\Models\restaurant_time_slot;
use App\Models\category;
use App\Models\country;
use App\CPU\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use App\CPU\Helpers;
use Validator;

class RestaurantController extends Controller
{
    public function create_restaurant()
    {
        $category = category::where('cat_status',1)->orderBy('cat_name','ASC')->get();
        $country = country::orderBy('country_name','ASC')->get();
        return view('WEB.restaurant-sign-up',compact('category','country'));
    }

    public function check_mobile(Request $request)
    {
        if (restaurant::where('restaurant_mobile',$request->restaurant_mobile)->exists()) 
        {
           echo '200';
        }
        else
        {
            echo '400';
        }
    }

    public function store_restaurant(Request $request)
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
            'license_no'=>$data['license_no'] ? $data['license_no'] : 'N/A',
            'aadhar_no'=>$data['aadhar_no'] ? $data['aadhar_no'] : 'N/A',
            'pancard_no'=>$data['pancard_no'] ? $data['pancard_no'] : 'N/A',
            'voter_card_no'=>$data['voter_card_no'] ? $data['voter_card_no'] : 'N/A',
            'restaurant_contact_person'=>$data['restaurant_contact_person'] ? $data['restaurant_contact_person'] : 'N/A',
            'restaurant_phone'=>$data['restaurant_phone'] ? $data['restaurant_phone'] : 'N/A',
            'shipping_charge'=>$data['shipping_charge'] ? $data['shipping_charge'] : '0',
            'delivery_type'=>$data['delivery_type'] ? $data['delivery_type'] : 'N/A',
            'restaurant_about'=>$data['restaurant_about'] ? $data['restaurant_about'] : 'N/A',
            'restaurant_device_id'=>'N/A',
        );

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

                // if (!empty($request->file('gallery_image'))) {
                //     foreach ($request->gallery_image as $img) {
                //         $data1 = new restaurant_gallery();
                //         $data1->restaurant_id = $restaurant_id;
                //         $data1->gallery_image = ImageManager::upload('modal/', 'png', $img);
                //         $data1->save();
                //     }
                // }

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

                Toastr::success('Success! Restaurant Registered');
                return redirect()->route('home');
            }
    }
}
