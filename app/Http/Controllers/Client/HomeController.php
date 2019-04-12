<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        return view('client.index');
    }

    public function about() {
        return 'Giới thiệu';
    }

    public function contact() {
        return 'Liên hệ';
    }
}
