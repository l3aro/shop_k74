<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        return view('admin.product.index');
    }

    public function create() {
        return view('admin.product.create');
    }

    public function store(Request $request) {

        $this->validate($request,
            [
                'name' => 'required',
                'price' => 'required',
            ],
            [
                'required'=> ':attribute field is required',
            ]
        );

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'highlight' => $request->highlight,
            'quantity' => $request->quantity,
            'avatar' => $request->avatar,
            'description' => $request->description
        ]);

        session()->flash('add_product', 'success');

        return redirect('/admin/products/'.$product->id.'/edit');
    }

    public function edit(Product $product) {
        return view('admin.product.edit', compact('product'));
    }
}
