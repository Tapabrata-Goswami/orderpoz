<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant_category extends Model
{
    use HasFactory;
    protected $primaryKey='restaurant_cat_id';
    protected $table='restaurant_categories';
    public $timestamps=false;
    protected $fillable=['restaurant_id','cat_id','menu_id','menu_title','menu_price','menu_image','menu_description','rest_menu_status','is_veg'];

    public function catmenus()
    {
        return $this->hasMany(menu_item::class,'cat_id','cat_id');
    }

}
