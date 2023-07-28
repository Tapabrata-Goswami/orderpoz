<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    protected $primaryKey='slider_id';
    protected $table='sliders';
    public $timestamps=true;
    protected $fillable=['restaurant_id','slider_status','slider_image','slider_created','created_at','updated_at'];
}
