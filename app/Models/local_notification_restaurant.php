<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local_notification_restaurant extends Model
{
    use HasFactory;
    protected $primaryKey='restaurant_noti_id';
    protected $table='local_notification_restaurants';
    public $timestamps=true;
    protected $fillable=['noti_restaurant_id','noti_type','noti_msg','noti_status'];
}
