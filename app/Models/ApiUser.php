<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'api_users';

    protected $fillable = [
        'curp',
        'nombres',
        'apellidoPaterno',
        'apellidoMaterno'
    ];
}
