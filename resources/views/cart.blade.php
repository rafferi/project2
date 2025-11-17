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

        @if($cartItems->count() > 0)
            <div class="content-row">
                @foreach($cartItems as $item)
                    <div class="product_item">
                        <a href="products/{{ $item->product->id}}" style="text-decoration: none;">
                            <div>
                                <img src="{{ asset($item->product->image)}}" alt="{{$item->product->name}}" width='300'>
                            </div>
                            <h2>{{$item->product->name}}</h2>
                            <h3>{{$item->product->price}} руб.</h3>
                        </a>

                        <div>
                            <form action="{{ route('cart.update', $item->product->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <label>Количество:</label>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99" style="width: 60px;">
                                <button type="submit">Обновить</button>
                            </form>

                            <form action="{{ route('cart.destroy', $item->product->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Удалить из корзины">
                                    <img src="{{ asset('images/icons/cart_delete.png') }}" alt="Удалить из корзины">
                                </button>
                            </form>
                        </div>

                        <div>
                            <strong>Сумма: {{ $item->product->price * $item->quantity }} руб.</strong>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 20px; font-size: 1.2em;">
                <strong>Общая сумма: {{ $total }} руб.</strong>
            </div>
        @else
            <p>Ваша корзина пуста</p>
        @endif
    </div>
@endsection
