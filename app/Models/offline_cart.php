<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offline_cart extends Model
{
    use HasFactory;
    protected $primaryKey='offline_id';
    protected $table='offline_carts';
    public $timestamps=true;
    protected $fillable=['random_id','restaurant_cat_id','restaurant_id','outlet_id','cat_id','menu_id','menu_title','menu_price','menu_image','qty'];
}
