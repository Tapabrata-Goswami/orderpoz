<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
    protected $primaryKey='state_id';
    protected $table='states';
    public $timestamps=true;
    protected $fillable=['state_name','code','countryid'];
}
