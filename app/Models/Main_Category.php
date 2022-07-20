<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'main_category',
        'thumbnail',
        'deleted_at',
    ];
}
