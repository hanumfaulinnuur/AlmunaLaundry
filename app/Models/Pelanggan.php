<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = ['id_user', 'no_telepon', 'alamat', 'latitude', 'longitude', 'deposit_saldo'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
