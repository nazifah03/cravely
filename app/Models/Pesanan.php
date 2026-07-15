<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pelanggan',
        'id_barista',
        'tanggal_pesan',
        'total',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pesan' => 'datetime',
            'total' => 'decimal:2',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function barista(): BelongsTo
    {
        return $this->belongsTo(Barista::class, 'id_barista', 'id_barista');
    }

    /**
     * Rincian item-item yang dipesan dalam pesanan ini.
     */
    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id_pesanan');
    }
}