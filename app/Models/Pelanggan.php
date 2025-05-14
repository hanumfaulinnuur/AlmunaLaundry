<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\SaldoHistori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = ['id_user', 'no_telepon', 'alamat', 'latitude', 'longitude', 'deposit_saldo'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function Transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id');
    }

    public function Saldo_Histori(): HasMany
    {
        return $this->hasMany(SaldoHistori::class, 'id_pelanggan', 'id');
    }
}
