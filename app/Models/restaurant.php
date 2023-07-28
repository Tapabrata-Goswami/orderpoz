<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class restaurant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey='restaurant_id';
    protected $table='restaurants';
    public $timestamps=true;
    protected $fillable = [
        'restaurant_status',
        'restaurant_name',
        'restaurant_mobile',
        'restaurant_email',
        'restaurant_image',
        'restaurant_gps_address',
        'restaurant_gps_lat',
        'restaurant_gps_lng',
        'password',
        'restaurant_device_id',
        'auth_token',
        'remember_token',
        'license_no',
        'aadhar_no',
        'aadhar_front_image',
        'aadhar_back_image',
        'pancard_no',
        'pancard_front_image',
        'pancard_back_image',
        'voter_card_no',
        'voter_front_image',
        'voter_back_image',
        'email_verified_at',
        'total_rating',
        'restaurant_about',
        'country_id',
        'restaurant_state',
        'restaurant_city',
        'restaurant_area',
        'shipping_charge',
        'restaurant_name_code',
        'select_kyc',
        'restaurant_contact_person',
        'restaurant_phone',
        'delivery_type',
        'secret_key',
        'publish_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    public function restmenus()
    {
        return $this->hasMany(restaurant_category::class,'restaurant_id','restaurant_id')->leftjoin('menu_items','menu_items.cat_id','restaurant_categories.cat_id')->leftjoin('categories','categories.cat_id','restaurant_categories.cat_id');
    }

    public function gallery()
    {
        return $this->hasMany(restaurant_gallery::class,'restaurant_id','restaurant_id');
    }

}
