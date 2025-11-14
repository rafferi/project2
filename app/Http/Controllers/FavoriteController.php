<?php
namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favoriteProducts()->paginate(6);
        return view('favorites', compact('favorites'));
    }

    public function store($product_id)
    {
        $user = auth()->user();

        Favorite::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $product_id
        ]);

        return back()->with('success', 'Товар добавлен в избранное');
    }

    public function destroy($product_id)
    {
        $user = auth()->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Товар удален из избранного');
        }

        return back()->with('error', 'Товар не найден в избранном');
    }
}
