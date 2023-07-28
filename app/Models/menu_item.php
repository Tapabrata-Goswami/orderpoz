<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_item extends Model
{
    use HasFactory;
    protected $primaryKey='menu_id';
    protected $table='menu_items';
    public $timestamps=true;
    protected $fillable=['cat_id','menu_status','menu_title','menu_price','menu_image','menu_description','is_veg'];

}
