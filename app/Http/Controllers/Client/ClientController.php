<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function index(){
        return view('client.index');
    }
    function chitiet(){
        return view('client.chitiet');
    }
    function lienhe(){
        return view('client.lienhe');
    }
    function listdanhsach(){
        return view('client.listdanhsach');
    }
    // function register(){
    //     return view('client.register');
    // }
}
