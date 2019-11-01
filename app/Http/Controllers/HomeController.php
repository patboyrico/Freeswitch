<?php

namespace App\Http\Controllers;

use App\Freeswitch\FreeswitchESL;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $freeswitch = new FreeswitchESL();
        $connect = $freeswitch->connect("127.0.0.1","8021","ClueCon");
        $version = $freeswitch->api("help");
        dd($version);
    }
}
