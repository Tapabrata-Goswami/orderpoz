<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detail;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\restaurant;
use App\Models\web_contact;
use App\CPU\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use App\CPU\Helpers;

class DetailController extends Controller
{
    // ********* PRIVACY************

    public function privacy()
    {
            $privacy=detail::where('id','1')->first();
            return view('Admin.privacy', compact('privacy'));
        
    }

    public function change_privacy(Request $request)
    {
            $ins=array(
                'privacy_policy'=>$request['privacy_policy'],
            );
           detail::where('id',1)->update($ins);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function tc()
    {
            $tc=detail::where('id','1')->first();
            return view('Admin.tc', compact('tc'));
        
    }

    public function change_tc(Request $request)
    {
            $ins=array(
                'tc'=>$request['tc'],
            );
           detail::where('id',1)->update($ins);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function about()
    {
            $about=detail::where('id','1')->first();
            return view('Admin.about', compact('about'));
        
    }

    public function change_about(Request $request)
    {
            $ins=array(
                'about_us'=>$request['about_us'],
            );
           detail::where('id',1)->update($ins);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function refund()
    {
            $refund=detail::where('id','1')->first();
            return view('Admin.refund', compact('refund'));
        
    }

    public function change_refund(Request $request)
    {
            $ins=array(
                'refund_policy'=>$request['refund_policy'],
            );
           detail::where('id',1)->update($ins);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function contact_us()
    {
        $contact=detail::where('id','1')->first();
        
        return view('Admin.contact-us', compact('contact'));
    }

    public function change_contact_us(Request $request)
    {
            $ins=array(
                'contact_email'=>$request['contact_email'],
                'contact_mobile'=>$request['contact_mobile'],
            );
           
           detail::where('id',1)->update($ins);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function other()
    {
        $business=BusinessSetting::where('id','2')->first();
        $detail=detail::where('id','1')->first();
        
        return view('Admin.other', compact('detail','business'));
    }

    public function change_other(Request $request)
    {
            $ins=array(
                'user_key'=>$request['user_key'],
                'restaurant_key'=>$request['restaurant_key'],
            );
            $ins1=array(
                'value'=>$request['value'],
            );
           
           detail::where('id',1)->update($ins);
           BusinessSetting::where('id',2)->update($ins1);
           Toastr::success('Success! Updated');
           return redirect()->back();
    }

    public function notification()
    {
        return view('Admin.notification');
    }

    public function noti(request $request)
    {
        if($request->data=='user')
        {
            $users = User::where('status',1)->where('device_id','!=','')->get();
            
                $data = [
                    'title' => 'Orderpoz',
                    'description' => $request->user_key,
                ];
                Helpers::send_to_device_topic('user','Order_User',$data);
        }
        else
        {
            
            $restaurant = restaurant::where('restaurant_status',1)->where('restaurant_device_id','!=','')->first();

                $data = [
                    'title' => 'Orderpoz Restaurant',
                    'description' => $request->user_key,
                ];
                Helpers::send_to_device_topic('restaurant','Order_Restaurant',$data);
        }
            Toastr::success('Success! Notification Sent');
            return redirect()->back();
    }

    public function web_contact_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $web = web_contact::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('web_contacts.firstname', 'like', "%{$value}%")->orwhere('web_contacts.lastname', 'like', "%{$value}%")->orwhere('web_contacts.contact_phone', 'like', "%{$value}%")->orwhere('web_contacts.contact_email', 'like', "%{$value}%");
                }
            })->orderBy('contact_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $web = web_contact::orderBy('web_contacts.contact_id', 'desc');
        }
        $web = $web->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.web-contact-list', compact('web','search'));
    }

    public function delete_web_contact($contact_id)
    {
        $web_contact=web_contact::find($contact_id);
        $web_contact->delete();
        Toastr::success('Success! Deleted');
        return redirect()->back();
    }
}
