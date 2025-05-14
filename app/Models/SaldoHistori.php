<?php

namespace App\Models;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;

class SaldoHistori extends Model
{

    protected $fillable = ['id_pelanggan', 'nominal', 'tanggal_transaksi', 'jenis_transaksi'];
    
    public function Pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
}
