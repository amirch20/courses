<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site_Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title',
        'banner_sub_title',
        'cookie_status',
        'cookie_note',
        'cookie_policy',
        'about_us',
        'term_and_condition',
        'privacy_policy',
        'banner_images',
        'small_logo',
        'orignal_logo',
        'favicon',
        'deleted_at',

    ];
}
