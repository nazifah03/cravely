<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * Casts otomatis. Password akan di-hash otomatis setiap kali di-set
     * (mis. Barista::create(['password' => 'plaintext'])), sehingga tidak perlu
     * panggil Hash::make() manual lagi di controller/seeder.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: satu barista bisa menangani banyak pesanan.
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_barista', 'id_barista');
    }

    /**
     * Helper untuk cek apakah barista ini admin.
     * Case-insensitive supaya konsisten dengan pengecekan login.
     */
    public function isAdmin(): bool
    {
        return strtolower($this->posisi) === 'admin';
    }
}