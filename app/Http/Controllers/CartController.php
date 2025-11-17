<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $productsIds = auth()->user()->carts()->pluck('product_id')->toArray();
        $products = Product::findMany($productsIds);
        return view('cart', compact('products'));
    }

    public function store($product_id)
    {
        auth()->user()->carts()->firstOrCreate([
            'product_id' => $product_id
        ]);
        return back()->with('success', 'Товар добавлен в корзину');
    }

    public function destroy($product_id)
    {
        auth()->user()->carts()->where('product_id', $product_id)->delete();

        return back()->with('success', 'Товар удален из корзины');
    }
}
