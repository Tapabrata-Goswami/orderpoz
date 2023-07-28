<?php

namespace App\CPU;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\restaurant;
use App\Models\detail;

class Helpers
{
    public static function module_permission_check($mod_name)
    {
        $permission = auth('admin')->user()->module_access;
        if (isset($permission) && in_array($mod_name, (array)json_decode($permission)) == true) {
            return true;
        }

        if (auth('admin')->user()->role_id == 0) {
            return true;
        }
        return false;
    }

    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
    
    public static function get_restaurant_by_token($request)
    {
        $data = '';
        $success = 0;

        $token = explode(' ', $request->header('authorization'));
        if (count($token) > 1 && strlen($token[1]) > 30) {
            $restaurant = restaurant::where(['auth_token' => $token['1']])->first();
            if (isset($restaurant)) {
                $data = $restaurant;
                $success = 1;
            }
        }

        return [
            'success' => $success,
            'data' => $data
        ];
    }

    public static function get_customer($request = null)
    {
        $user = null;
        if (auth()->check()) {
            $user = auth()->user(); // for web
        } elseif ($request != null && $request->user() != null) {
            $user = $request->user(); //for api
        } elseif (session()->has('id')) {
            $user = User::find(session('id'));
        }

        if ($user == null) {
            $user = 'offline';
        }

        return $user;
    }

    public static function send_to_device($is_user,$fcm_token,$data)
    {
        if ($is_user=='user') 
        {
            $key = detail::first()->user_key;
        }
        else
        {
            $key = detail::first()->restaurant_key;
        }
        
        $url = "https://fcm.googleapis.com/fcm/send";
        $header = array("authorization: key=" . $key . "",
            "content-type: application/json"
        );

        $postdata = '{
            "to" : "' . $fcm_token . '",
            "data" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0
              },
              "notification" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0,
                "icon" : "new",
                "sound" : "default"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);

        return $result;
    }

    public static function send_to_device_topic($is_user,$topic,$data)
    {
        if ($is_user=='user') 
        {
            $key = detail::first()->user_key;
        }
        else
        {
            $key = detail::first()->restaurant_key;
        }

        $url = "https://fcm.googleapis.com/fcm/send";
        $header = ["authorization: key=" . $key . "",
            "content-type: application/json",
        ];

        $postdata = '{
            "to" : "/topics/'.$topic.'",
            "data" : {
                "title":"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0
              },
              "notification" : {
                "title":"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "is_read": 0,
                "icon" : "new",
                "sound" : "default"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);
        return $result;
    }

    public static function otp($receiver,$otp)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=rajasingh%40orderpoz.com&key=53856C7E-4F82-A4D4-C122-778F36DE577D&to='.$receiver.'&message=Dear%20Customer%2C%0APlease%20use%20OTP%20'.$otp.'%20to%20complete%20the%20login%20process.Kindly%20ignore%20this%20message%2Cif%20not%20initiated%20by%20you.Do%20not%20share%20this%20LOGIN%20OTP%20with%20anyone.',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function otpweb($receiver,$otp,$country_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=rajasingh%40orderpoz.com&key=53856C7E-4F82-A4D4-C122-778F36DE577D&to='.$country_code.''.$receiver.'&message=Dear%20Customer%2C%0APlease%20use%20OTP%20'.$otp.'%20to%20complete%20the%20login%20process.Kindly%20ignore%20this%20message%2Cif%20not%20initiated%20by%20you.Do%20not%20share%20this%20LOGIN%20OTP%20with%20anyone.',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function successuserorder($receiver,$order_id,$country_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=rajasingh@orderpoz.com&key=53856C7E-4F82-A4D4-C122-778F36DE577D&to='.$country_code.''.$receiver.'&message=Dear%20User,%20Thank%20you%20for%20placing%20an%20order%20at%20Orderpoz!%20You%20can%20track%20your%20order%20by%20order%20id%20'.$order_id.'.',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function successrestuarantorder($receiver,$country_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=rajasingh@orderpoz.com&key=53856C7E-4F82-A4D4-C122-778F36DE577D&to='.$country_code.''.$receiver.'&message=Hello!%20New%20order%20(Cust.%201)%20is%20received%20from%20Orderpoz.%20Check%20your%20Orderpoz%20dashboard%20for%20order%20details',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    
}