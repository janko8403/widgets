<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contests extends Model
{
    use HasFactory;

    protected $table = 'contests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'reg_accepted',
        'marketing_accepted',
        'idea',
        'birth_data',
        'validationString',
        'validated',
    ];


}
