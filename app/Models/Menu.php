<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_kopi',
        'harga',
        'size',
        'id_kategori',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi: satu menu bisa muncul di banyak baris detail_pesanan
     * (mis. dipesan berkali-kali di pesanan yang berbeda-beda).
     */
    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_menu', 'id_menu');
    }
}