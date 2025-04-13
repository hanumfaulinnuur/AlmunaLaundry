<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function tentangKami()
    {
        return view('tentang_kami');
    }

    public function lacakStatus()
    {
        return view('lacak_status');
    }
}
