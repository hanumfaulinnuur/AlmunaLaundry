<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = ['id_transaksi', 'tanggal_pembayaran', 'jenis_pembayaran', 'status_pembayaran'];

    public function Transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }
}
