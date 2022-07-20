<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_title',
        'instructor',
        'short_description',
        'description',
        'level',
        'requirements',
        'outcomes',
        'price',
        'discount_price',
        'course_privacy',
        'thumbnail',
    ];
}
