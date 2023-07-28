<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $primaryKey='cat_id';
    protected $table='categories';
    public $timestamps=true;
    protected $fillable=['cat_status','restaurant_id','cat_name','cat_image'];

    
}
