@extends('layouts.layout')
@section('title', 'Товар')
@section('content')
    <div class="content-row">
        <div class="product_item">
            <div>
                <img src="{{ asset($data->image)}}" alt="{{$data->name}}" width='300'>
            </div>
            <h2>{{$data->name}}</h2>
            <h3>{{$data->price}} руб.</h3>
            <a href="{{route('products.index')}}">Назад</a>
            <br><br>

            @auth
                <div class="product-actions">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('products.edit', $data->id) }}">Редактировать</a>
                        <form action="{{route('products.destroy', $data->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    @else
                        @if(auth()->user()->favoriteProducts && auth()->user()->favoriteProducts->contains($data->id))
                            <form action="{{ route('favorites.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Убрать из избранного">
                                    <img src="{{ asset('images/icons/not_favorite.png') }}" alt="Убрать из избранного">
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorites.store', $data->id) }}" method="post">
                                @csrf
                                <button type="submit" title="Добавить в избранное">
                                    <img src="{{ asset('images/icons/dont_like.png') }}" alt="Добавить в избранное">
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->cartProducts && auth()->user()->cartProducts->contains($data->id))
                            <form action="{{ route('cart.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Убрать из корзины">
                                    <img src="{{ asset('images/icons/cart_delete.png') }}" alt="Убрать из корзины">
                                </button>
                            </form>
                        @else
                            <form action="{{ route('cart.store', $data->id) }}" method="post">
                                @csrf
                                <button type="submit" title="Добавить в корзину">
                                    <img src="{{ asset('images/icons/cart_add.png') }}" alt="Добавить в корзину">
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            @endauth
        </div>
        <div class="content_column">
            <div class="text_content">
                <h2>{{$data->name}}</h2>
                <h3>Описание: {{$data->description}}</h3>
                <hr>
                <p>Цена: {{$data->price}} руб.</p>
                <p>Категория: {{$data->category}}</p>
                <p>Количество: {{$data->qty}}</p>
            </div>
        </div>
    </div>
@endsection
