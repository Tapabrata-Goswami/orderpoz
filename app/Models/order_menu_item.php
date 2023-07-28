<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_menu_item extends Model
{
    use HasFactory;
    protected $primaryKey='order_item_id';
    protected $table='order_menu_items';
    public $timestamps=true;
    protected $fillable=['order_id','user_id','restaurant_cat_id','restaurant_id','outlet_id','cat_id','menu_id','menu_title','per_menu_price','menu_image','menu_qty','total_menu_price','add_on_name'];
}
