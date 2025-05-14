<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = [
        'id_pelanggan',
        'id_service',
        'no_invoice',
        'tanggal_order',
        'tanggal_selesai',
        'total_berat',
        'total_harga',
        'status_transaksi',
    ];
    public function Pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
    public function Service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'id_service', 'id');
    }
}
