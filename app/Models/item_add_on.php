<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_add_on extends Model
{
    use HasFactory;
    protected $primaryKey='add_on_id';
    protected $table='item_add_ons';
    public $timestamps=false;
    protected $fillable=['menu_id','add_on_name'];
}
