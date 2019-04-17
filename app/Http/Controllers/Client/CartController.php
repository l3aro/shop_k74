<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index() {
        return 'Giỏ hàng';
    }

    public function checkout() {
        return 'Thanh toán';
    }

    public function complete() {
        return 'Thành công';
    }
}
