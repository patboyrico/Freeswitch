<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Currency;
use App\EndUser;
use App\UserExtension;
use App\UserConfiguration;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Freeswitch\FreeswitchESL;

class HomeController extends Controller
{
    public function index()
    {
       return redirect()->route('login');
    }

    public function createFreeswitch()
    {

    }

    public function xmlHandler()
    {

    }



}
