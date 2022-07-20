<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'site_title',
        'site_keyword',
        'description',
        'author',
        'slogan',
        'system_email',
        'phone',
        'address',
    ];

}
