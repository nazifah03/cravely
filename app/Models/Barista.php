<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Barista extends Authenticatable
{
    use Notifiable;

    protected $table = 'barista';
    protected $primaryKey = 'id_barista';

    // id_barista disesuaikan dengan skema database yang sudah ada: integer auto increment.

    protected $fillable = [
        'nama',
        'posisi',
        'shift',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
