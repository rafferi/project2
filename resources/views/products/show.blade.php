@extends('layouts.layout')
@section('title', 'Товар')
@section('content')
    <div class="content-row">
        <div class="product_item">
            <div>
                <img src="{{ asset($data->image)}}" alt="{{$data->name}}"  width='300 '>
            </div>
            <h2>{{$data->name}}</h2>
            <h3>{{$data->price}}</h3>
            <a href="{{route('products.index')}}">Назад</a>
            <br><br>

            @auth
                <div class="product-actions">
                    <a href="{{ route('products.edit', $data->id) }}" class="btn btn-danger">Редактировать</a>
                    <form action="{{route('products.destroy', $data->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>

                    @if(auth()->user()->favoriteProducts->contains($data->id))
                        <form action="{{ route('favorites.destroy', $data->id) }}" method="post" class="favorite-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="favorite-btn" title="Убрать из избранного">
                                <img src="{{ asset('images/icons/not_favorite.png') }}" alt="Убрать из избранного" class="favorite-icon">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $data->id) }}" method="post" class="favorite-form">
                            @csrf
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">
                                <img src="{{ asset('images/icons/dont_like.png') }}" alt="Добавить в избранное" class="favorite-icon">
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
        <div class="content_column">
            <div class="text_content">
                <h2>{{$data->name}}</h2>
                <h3>Описание: {{$data->description}}</h3>
                <hr>
                <p>{{$data->price}}</p>
                <p>Категория: {{$data->category}}</p>
                <p>Количество: {{$data->qty}}</p>
                <p>Характеристики: {{$data->description}}</p>
            </div>
        </div>
    </div>
@endsection
