<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function detail(Product $product) 
    {
        
        return view('client.product', compact('product'));
    }

    public function shop() 
    {
        $products = Product::paginate(12);
        return view('client.shop', compact('products'));
    }
}
