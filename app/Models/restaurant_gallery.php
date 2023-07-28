<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant_gallery extends Model
{
    use HasFactory;
    protected $primaryKey='gallery_id';
    protected $table='restaurant_galleries';
    public $timestamps=false;
    protected $fillable=['restaurant_id','gallery_image'];
}
