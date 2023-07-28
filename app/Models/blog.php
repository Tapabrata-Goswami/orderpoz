<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $primaryKey='blog_id';
    protected $table='blogs';
    public $timestamps=true;
    protected $fillable=['blog_status','blog_title','blog_person','blog_image','blog_description'];
}
