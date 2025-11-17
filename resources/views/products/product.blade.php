@auth

    @if(auth()->user()->favoriteProducts && auth()->user()->favoriteProducts->contains($prod->id))
        <form action="{{ route('favorites.destroy', $prod->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" title="Убрать из избранного">
                <img src="{{ asset('images/icons/like.png') }}" alt="Убрать из избранного">
            </button>
        </form>
    @else
        <form action="{{ route('favorites.store', $prod->id) }}" method="post">
            @csrf
            <button type="submit" title="Добавить в избранное">
                <img src="{{ asset('images/icons/dont_like.png') }}" alt="Добавить в избранное">
            </button>
        </form>
    @endif


    @if(auth()->user()->cartProducts && auth()->user()->cartProducts->contains($prod->id))
        <form action="{{ route('cart.destroy', $prod->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" title="Убрать из корзины">
                <img src="{{ asset('images/icons/cart_delete.png') }}" alt="Убрать из корзины">
            </button>
        </form>
    @else
        <form action="{{ route('cart.store', $prod->id) }}" method="post">
            @csrf
            <button type="submit" title="Добавить в корзину">
                <img src="{{ asset('images/icons/cart_add.png') }}" alt="Добавить в корзину">
            </button>
        </form>
    @endif
@endauth
