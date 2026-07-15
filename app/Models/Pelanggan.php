<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
    ];

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function reservasi(): HasMany
    {
        return $this->hasMany(Reservasi::class, 'id_pelanggan', 'id_pelanggan');
    }
}