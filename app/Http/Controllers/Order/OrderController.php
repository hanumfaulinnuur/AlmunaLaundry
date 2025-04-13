<?php

namespace App\Http\Controllers\Order;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function listLaynaan()
    {
        $listLayanan = Service::all();
        return view('order.list_layanan' , compact('listLayanan'));
    }
}
