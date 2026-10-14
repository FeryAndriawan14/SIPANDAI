<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
        return view('masyarakat.bantuan.index');
    }
}
