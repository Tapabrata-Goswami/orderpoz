<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant_outlet extends Model
{
    use HasFactory;
    protected $primaryKey='outlet_id';
    protected $table='restaurant_outlets';
    public $timestamps=false;
    protected $fillable=['outlet_status','restaurant_id','outlet_gps_address','outlet_gps_lat','outlet_gps_lng','outlet_state','outlet_city','outlet_area','is_main'];
}
