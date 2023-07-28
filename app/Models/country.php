<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    protected $primaryKey='country_id';
    protected $table='countries';
    public $timestamps=false;
    protected $fillable=['country_name','country_code','country_currency'];
}
