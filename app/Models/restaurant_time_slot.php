<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant_time_slot extends Model
{
    use HasFactory;
    protected $primaryKey='time_slot_id';
    protected $table='restaurant_time_slots';
    public $timestamps=false;
    protected $fillable=['restaurant_id','day','from_time','to_time','is_close'];
}
