<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TestDump extends Controller
{
    function itemList(){
        return User::all();
    }

    function apiconnect(Request $request) {
        return ($request);
        return ('You have connected to interface API!');
    }
}
