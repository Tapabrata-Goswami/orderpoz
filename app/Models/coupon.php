<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    protected $primaryKey='coupon_id';
    protected $table='coupons';
    public $timestamps=true;
    protected $fillable=['coupon_status','coupon_title','coupon_code','coupon_type','amount_percent','coupon_validity','coupon_image','coupon_description','country_id'];
}
