<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multiple_Choice extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_question',
        'number_of_options',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'deleted_at',

    ];
}
