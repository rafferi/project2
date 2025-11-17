@extends('layouts.layout')
@section('title', 'Корзина')
@section('content')
    <div class="content">
        <h2>Корзина</h2>

        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if($products->count() > 0)
            <div class="content-row">
                @foreach($products as $prod)
                    <div class="product_item">
                        <a href="{{ route('products.show', $prod->id) }}" style="text-decoration: none;">
                            <div>
                                <img src="{{ asset($prod->image)}}" alt="{{$prod->name}}" width='300'>
                            </div>
                            <h2>{{$prod->name}}</h2>
                            <h3>{{$prod->price}} руб.</h3>
                        </a>

                        <form action="{{ route('cart.destroy', $prod->id) }}" method="post" class="cart-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cart-btn" title="Удалить из корзины">
                                <img src="{{ asset('images/icons/cart_delete.png') }}" alt="Удалить из корзины" class="cart-icon">
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p>Ваша корзина пуста</p>
        @endif
    </div>
@endsection
