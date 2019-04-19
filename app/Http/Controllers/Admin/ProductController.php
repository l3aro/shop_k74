<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {

        $products = Product::paginate(7);

        return view('admin.product.index', compact('products'));
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

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([], 204);
    }

    public function update(Product $product, Request $request) {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->highlight = $request->highlight;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->save();

        return back();
    }
}
