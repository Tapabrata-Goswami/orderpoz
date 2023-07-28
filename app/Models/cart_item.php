<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    use HasFactory;
    protected $primaryKey='cart_id';
    protected $table='cart_items';
    public $timestamps=true;
    protected $fillable=['user_id','restaurant_cat_id','restaurant_id','outlet_id','cat_id','menu_id','menu_title','menu_price','menu_image','qty','add_on_name'];
}
