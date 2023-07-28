<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class web_contact extends Model
{
    use HasFactory;
    protected $primaryKey='contact_id';
    protected $table='web_contacts';
    public $timestamps=true;
    protected $fillable=['firstname','lastname','contact_phone','contact_email','contact_message'];
}
