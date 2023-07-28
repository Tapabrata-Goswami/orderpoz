<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $primaryKey='area_id';
    protected $table='areas';
    public $timestamps=true;
    protected $fillable=['area_name','state_id','city_id'];
}
