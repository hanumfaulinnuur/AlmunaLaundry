<?php

namespace App\Http\Controllers\Saldo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function lihatSaldo()
    {
        return view('saldo.view');
    }
}
