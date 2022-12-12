<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.Dashboard.index');
    }

    public function funcionario()
    {
        return view('admin.Dashboard.funcionario');
    }
}
