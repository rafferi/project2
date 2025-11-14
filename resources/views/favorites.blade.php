@extends('layouts.layout')
@section('title', 'Избранное')
@section('content')
    <div class="content">
        <h2>Избранные товары</h2>

        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert-error">
                {{ session()->get('error') }}
            </div>
        @endif

        @if($favorites->count() > 0)
            <div class="content-row">
                @foreach($favorites as $product)
                    <div class="product_item">
                        <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none;">
                            <div>
                                <img src="{{ asset($product->image)}}" alt="{{$product->name}}" width='300'>
                            </div>
                            <h2>{{$product->name}}</h2>
                            <h3>{{$product->price}} руб.</h3>
                        </a>

                        <div class="product-actions">
                            <form action="{{ route('favorites.destroy', $product->id) }}" method="post" class="favorite-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="favorite-btn" title="Убрать из избранного">
                                    <img src="{{ asset('images/icons/not_favorite.png') }}" alt="Убрать из избранного" class="favorite-icon">
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($favorites->hasPages())
                <div class="pagination-container">
                    <div class="pagination-info">
                        Показано {{ $favorites->firstItem() }} - {{ $favorites->lastItem() }} из {{ $favorites->total() }} товаров
                    </div>

                    <div class="pagination">
                        @if($favorites->onFirstPage())
                            <span class="page-link disabled">Назад</span>
                        @else
                            <a href="{{ $favorites->previousPageUrl() }}" class="page-link">Назад</a>
                        @endif

                        @if($favorites->hasMorePages())
                            <a href="{{ $favorites->nextPageUrl() }}" class="page-link">Далее</a>
                        @else
                            <span class="page-link disabled">Далее</span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="empty-favorites">
                <p>В избранном пока нет товаров</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Перейти к товарам</a>
            </div>
        @endif
    </div>
@endsection
