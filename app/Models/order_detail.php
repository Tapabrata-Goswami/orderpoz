<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    protected $primaryKey='o_id';
    protected $table='order_details';
    public $timestamps=true;
    protected $fillable=['order_id','order_status','restaurant_id','outlet_id','order_type','user_id','payment_type','basic_amount','coupon_code','coupon_amount','shipping_charge','grand_total','user_name','user_mobile','user_email','pincode','house_flat_no','road_area_name','gps_address','gps_lat','gps_lng','delivered_date','cancel_reason','cancel_date'];

    public function order_items()
    {
        return $this->hasMany(order_menu_item::class,'order_id','order_id');
    }

    public function order_outlet()
    {
        return $this->hasOne(restaurant_outlet::class,'outlet_id','outlet_id');
    }
}
