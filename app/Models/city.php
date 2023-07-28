<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $primaryKey='city_id';
    protected $table='cities';
    public $timestamps=true;
    protected $fillable=['city_name','state_id'];
}
