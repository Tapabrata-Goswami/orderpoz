<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_table extends Model
{
    use HasFactory;
    protected $primaryKey='book_table_id';
    protected $table='book_tables';
    public $timestamps=true;
    protected $fillable=['user_id','book_table_status','restaurant_id','firstname','lastname','email','phone','date_time','person'];
}
