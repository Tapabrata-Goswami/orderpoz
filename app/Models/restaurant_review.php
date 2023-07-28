<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant_review extends Model
{
    use HasFactory;
    protected $primaryKey='review_id';
    protected $table='restaurant_reviews';
    public $timestamps=true;
    protected $fillable=['restaurant_id','user_id','order_id','restaurant_review','restaurant_rate'];
}
