<?php

namespace App\Http\Controllers;

use App\Freeswitch\FreeswitchESL;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
       return redirect()->route('login');
    }
}
