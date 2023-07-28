<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\CPU\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\slider;
use App\Models\restaurant;
use App\Models\restaurant_category;
use App\Models\restaurant_gallery;
use App\Models\restaurant_review;
use App\Models\restaurant_outlet;
use App\Models\restaurant_time_slot;
use App\Models\local_notification_restaurant;
use App\Models\book_table;
use App\Models\detail;
use App\Models\offline_cart;
use App\Models\cart_item;
use App\Models\web_contact;
use App\Models\blog;
use App\CPU\CartManager;
use Validator;

class WebController extends Controller
{
    public function home()
    {
        $slider = slider::leftjoin('restaurants','restaurants.restaurant_id','sliders.restaurant_id')->select('sliders.*','restaurants.restaurant_id','restaurants.restaurant_name','restaurants.restaurant_name_code')->where('sliders.slider_status',1)->orderby('sliders.slider_id','DESC')->get();

        $blog = blog::where('blog_status',1)->orderby('blog_id','DESC')->get()->take(3);

        return view('WEB.home',compact('slider','blog'));
    }

    public function restaurant_order($restaurant_name_code)
    {
        $restaurant = restaurant::leftjoin('countries','countries.country_id','restaurants.country_id')->where('restaurant_name_code',$restaurant_name_code)->first();

        $user = Helpers::get_customer();
        if ($user == 'offline') {
            $random_id = session()->get('user_random_id');
            if(offline_cart::where('random_id', $random_id)->where('restaurant_id',$restaurant->restaurant_id)->doesntExist())
            {
                offline_cart::where(['random_id' => $random_id])->delete();
            }
        }
        else
        {
            if(cart_item::where('user_id', $user->id)->where('restaurant_id',$restaurant->restaurant_id)->doesntExist())
            {
                cart_item::where(['user_id' => $user->id])->delete();
            }
        }

        $restaurant_category = restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('restaurant_categories.restaurant_id',$restaurant->restaurant_id)->where('categories.cat_status',1)->select('restaurant_categories.*','categories.cat_name')->groupby('restaurant_categories.cat_id')->get();

        $k=0;
        $cat_name = '';
        foreach($restaurant_category as $cat)
        {
            if($k==0)
            {
                $cat_name = $cat['cat_name'];
            }
            else
            {
                $cat_name .= ', '.$cat['cat_name'];
            }
            $k++;
        }

        $restaurant_gallery = restaurant_gallery::where('restaurant_id',$restaurant->restaurant_id)->orderby('gallery_id','DESC')->get();

        $restaurant_outlet = restaurant_outlet::where('restaurant_id',$restaurant->restaurant_id)->where('outlet_status',1)->orderby('is_main','DESC')->get();

        $restaurant_time_slot = restaurant_time_slot::where('restaurant_id',$restaurant->restaurant_id)->get();

        $restaurant_review = restaurant_review::leftjoin('users','users.id','restaurant_reviews.user_id')->where('restaurant_id',$restaurant->restaurant_id)->select('restaurant_reviews.*','users.name')->orderby('restaurant_reviews.review_id','DESC')->get();

        $cart = CartManager::get_cart();

        return view('WEB.restaurant-order',compact('restaurant','restaurant_category','cat_name','restaurant_gallery','restaurant_review','restaurant_outlet','restaurant_time_slot','cart'));
    }

    public function restaurant_checkout($restaurant_name_code)
    {
        $cartcnt = CartManager::get_cart();
        $cnt = $cartcnt->count();
        if ($cnt<=0) 
        {
            Toastr::warning('Warning! Your cart is empty!');
            // return redirect()->back();
            return redirect()->route('restaurant-order', [$restaurant_name_code]);
        }
        $user = Helpers::get_customer();
        if ($user == 'offline') 
        {
            $url='login-page';
        }
        else
        {
            $url='checkout-page';
        }
        $restaurant = restaurant::where('restaurant_name_code',$restaurant_name_code)->first();
        if($restaurant->delivery_type=='Delivery')
        {
            session()->put('order_type','Delivery');
        }
        elseif($restaurant->delivery_type=='Pickup')
        {
            session()->put('order_type','Pickup');
        }

        $restaurant_category = restaurant_category::leftjoin('categories','categories.cat_id','restaurant_categories.cat_id')->where('restaurant_categories.restaurant_id',$restaurant->restaurant_id)->groupby('restaurant_categories.cat_id')->get();

        $k=0;
        $cat_name = '';
        foreach($restaurant_category as $cat)
        {
            if($k==0)
            {
                $cat_name = $cat['cat_name'];
            }
            else
            {
                $cat_name .= ', '.$cat['cat_name'];
            }
            $k++;
        }

        $restaurant_gallery = restaurant_gallery::where('restaurant_id',$restaurant->restaurant_id)->orderby('gallery_id','DESC')->get();

        $restaurant_outlet = restaurant_outlet::where('restaurant_id',$restaurant->restaurant_id)->where('outlet_status',1)->orderby('is_main','DESC')->get();

        $restaurant_time_slot = restaurant_time_slot::where('restaurant_id',$restaurant->restaurant_id)->get();

        $restaurant_review = restaurant_review::leftjoin('users','users.id','restaurant_reviews.user_id')->where('restaurant_id',$restaurant->restaurant_id)->select('restaurant_reviews.*','users.name')->orderby('restaurant_reviews.review_id','DESC')->get();

        $cart = CartManager::get_cart();

        return view('WEB.restaurant-checkout',compact('restaurant','restaurant_category','cat_name','restaurant_gallery','restaurant_review','restaurant_outlet','restaurant_time_slot','url','cart'));
    }

    public function book_table(Request $request)
    {
        $user = Helpers::get_customer();
        if ($user == 'offline') {

            return [
                'status' => 0,
                'message' => 'Info! Please login first!'
            ];
        }
        else
        {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'date_time' => 'required',
                'person' => 'required',
            ]);
    
            if($validator->fails()){
                return response()->json(['errors' => Helpers::error_processor($validator)]);     
            }

            $ins=array(
                'firstname'=>$data['firstname'] ? $data['firstname'] : 'N/A',
                'lastname'=>$data['lastname'] ? $data['lastname'] : 'N/A',
                'email'=>$data['email'] ? $data['email'] : 'N/A',
                'date_time'=>$data['date_time'] ? $data['date_time'] : 'N/A',
                'person'=>$data['person'] ? $data['person'] : 'N/A',
                'phone'=>$data['phone'] ? $data['phone'] : 'N/A',
                'restaurant_id'=>$data['restaurant_id'] ? $data['restaurant_id'] : '0',
                'user_id'=>auth()->user()->id,
            );

                $book_table = book_table::create($ins);

                if ($book_table) 
                {
                    if (restaurant::where('restaurant_id',$book_table['restaurant_id'])->exists()) 
                    {
                        $restaurant = restaurant::where('restaurant_id',$book_table['restaurant_id'])->first();
                        $data = [
                            'title' => 'Orderpoz Restaurant',
                            'description' => 'Table booked by '.$data['firstname'].' on '.date('d M Y h:i A',strtotime($data['date_time'])),
                        ];
                        Helpers::send_to_device('restaurant',$restaurant->restaurant_device_id,$data);
                    }

                    $ins2=array(
                        'noti_restaurant_id'=>$book_table['restaurant_id'],
                        'noti_type'=>'1',
                        'noti_msg'=>'Table booked by '.$book_table['firstname'].' on '.date('d M Y h:i A',strtotime($book_table['date_time'])),
                        'noti_status'=>'1',
                    );
                    $local_notification = local_notification_restaurant::create($ins2);

                    return [
                        'status' => 1,
                        'message' => 'Success! Table is booked!'
                    ];
                }
                else
                {
                    return [
                        'status' => 0,
                        'message' => 'Error! Something went wrong!'
                    ];
                }
        }
    }

    public function blog_list()
    {
        $query_param = [];
        $blog = blog::where('blog_status',1)->orderby('blog_id','DESC')->paginate(6)->appends($query_param);

        return view('WEB.blog-list',compact('blog'));
    }

    public function blog_detail($blog_id)
    {
        $blog = blog::where('blog_id',$blog_id)->first();
        $recent = blog::where('blog_id','!=',$blog_id)->orderby('blog_id','DESC')->get()->take(4);

        return view('WEB.blog-detail',compact('blog','recent'));
    }

    public function about_us()
    {
        $detail = detail::where('id',1)->first();

        return view('WEB.about-us',compact('detail'));
    }

    public function terms_condition()
    {
        $detail = detail::where('id',1)->first();

        return view('WEB.terms-condition',compact('detail'));
    }

    public function privacy_policy()
    {
        $detail = detail::where('id',1)->first();

        return view('WEB.privacy-policy',compact('detail'));
    }

    public function contact()
    {
        $detail = detail::where('id',1)->first();

        return view('WEB.contact-us',compact('detail'));
    }

    public function contact_store(Request $request)
    {
        $input = $request->all();
        
        $ins=array(
            'firstname'=>$input['firstname'] ? $input['firstname'] : 'N/A',
            'lastname'=>$input['lastname'] ? $input['lastname'] : 'N/A',
            'contact_phone'=>$input['contact_phone'] ? $input['contact_phone'] : 'N/A',
            'contact_email'=>$input['contact_email'] ? $input['contact_email'] : 'N/A',
            'contact_message'=>$input['contact_message'] ? $input['contact_message'] : 'N/A',
        );
        $data=web_contact::create($ins);
        
        // Mail::to($input['senderemail'])->send(new \App\Mail\ContactMail($data->contact_id));
        Toastr::success('Success! submited');
            
        return redirect()->back();
    }

    public function order_type_session(Request $request)
    {
        session()->put('order_type',$request->type);
        return response()->json(['session successfully saved']);
    }
}
