<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='details';
    public $timestamps=false;
    protected $fillable=['about_us','tc','privacy_policy','user_key','restaurant_key','contact_mobile','contact_email','refund_policy'];
}
