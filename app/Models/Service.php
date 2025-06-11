<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['nama_service', 'deskripsi', 'harga'];

    public function Transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_service', 'id');
    }
}
