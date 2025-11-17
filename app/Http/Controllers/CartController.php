<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->carts()->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function store($product_id)
    {
        $user = auth()->user();
        $existingCartItem = $user->carts()->where('product_id', $product_id)->first();

        if ($existingCartItem) {
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + 1
            ]);
        } else {
            $user->carts()->create([
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request, $product_id)
    {
        $user = auth()->user();
        $cartItem = $user->carts()->where('product_id', $product_id)->first();

        if ($cartItem && $request->quantity > 0) {
            $cartItem->update([
                'quantity' => $request->quantity
            ]);
            return back()->with('success', 'Количество обновлено');
        }

        return back()->with('error', 'Ошибка при обновлении количества');
    }

    public function destroy($product_id)
    {
        auth()->user()->carts()->where('product_id', $product_id)->delete();
        return back()->with('success', 'Товар удален из корзины');
    }

    public function clear()
    {
        auth()->user()->carts()->delete();
        return back()->with('success', 'Корзина очищена');
    }
}
