<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child_Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'child_category',
        'deleted_at',

    ];
}
