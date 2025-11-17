@extends('layouts.layout')
@section('title', 'Товары')
@section('content')
    <div class="content">
        @auth()
            <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить товар</a>
        @endauth
        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="sorting-form" style="margin-bottom: 20px;">
            <h3>Сортировка</h3>
            <form method="get" class="filter-form">
                <div class="form_group">
                    <label for="sort">Сортировать:</label>
                    <select name="sort" id="sort">
                        <option value="">По умолчанию</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Сначала новые</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена по возрастанию</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена по убыванию</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название А-Я</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название Я-А</option>
                        <option value="qty_asc" {{ request('sort') == 'qty_asc' ? 'selected' : '' }}>Количество по возрастанию</option>
                        <option value="qty_desc" {{ request('sort') == 'qty_desc' ? 'selected' : '' }}>Количество по убыванию</option>
                    </select>
                </div>
                @if(request('name'))
                    <input type="hidden" name="name" value="{{ request('name') }}">
                @endif
                @if(request('qty_min'))
                    <input type="hidden" name="qty_min" value="{{ request('qty_min') }}">
                @endif
                @if(request('price_min'))
                    <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                @endif
                @if(request('price_max'))
                    <input type="hidden" name="price_max" value="{{ request('price_max') }}">
                @endif
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <button type="submit" class="btn">Применить</button>
            </form>
        </div>

        <div class="filter-sidebar">
            <h3>Фильтры</h3>
            <form method="get" class="filter-form">
                <div class="form_group">
                    <label for>Название</label>
                    <input type="text" name="name" value="{{request('name')}}">
                </div>
                <div class="form_group">
                    <label for="">Количество от</label>
                    <input type="number" name="qty_min" value="{{request('qty_min')}}">
                </div>
                <div class="form_group">
                    <label for="">Цена от</label>
                    <input type="number" name="price_min" value="{{request('price_min')}}">
                </div>
                <div class="form_group">
                    <label for="">Цена до</label>
                    <input type="number" name="price_max" value="{{request('price_max')}}">
                </div>
                <div class="form_group">
                    <label for="">Категория</label>
                    <select name="category_id">
                        <option value="">Все категории</option>
                        @foreach($categories as $categ)
                            <option value="{{ $categ->id }}" {{ request('category_id') == $categ->id ? 'selected' : '' }}>
                                {{ $categ->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <button type="submit" class="btn">Применить</button>
                <a href="{{route('products.index')}}" class="btn">Сбросить</a>
            </form>
        </div>

        <div class="content-row">
            @foreach($products as $prod)
                <div class="product_item">
                    <a href="products/{{ $prod->id}}" style="text-decoration: none;">
                        <div>
                            <img src="{{ asset($prod->image)}}" alt="{{$prod->name}}" width='300'>
                        </div>
                        <h2>{{$prod->name}}</h2>
                        <h3>{{$prod->price}} руб.</h3>
                    </a>

                    @auth
                        <!-- Кнопки избранного -->
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

                        <!-- Кнопки корзины -->
                        @if(auth()->user()->cartProducts && auth()->user()->cartProducts->contains($prod->id))
                            @foreach(auth()->user()->carts as $cart)
                                @if($cart->product_id == $prod->id)
                                    <div>
                                        <form action="{{ route('cart.update', $prod->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <label>В корзине:</label>
                                            <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="99" style="width: 50px;">
                                            <button type="submit">Обновить</button>
                                        </form>

                                        <form action="{{ route('cart.destroy', $prod->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Удалить из корзины">
                                                <img src="{{ asset('images/icons/cart_delete.png') }}" alt="Удалить из корзины">
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <form action="{{ route('cart.store', $prod->id) }}" method="post">
                                @csrf
                                <button type="submit" title="Добавить в корзину">
                                    <img src="{{ asset('images/icons/cart_add.png') }}" alt="Добавить в корзину">
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>

        @if($products->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </div>

                <div class="pagination">

                    @if($products->onFirstPage())
                        <span class="page-link disabled">Назад</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="page-link">Назад</a>
                    @endif


                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="page-link">Далее</a>
                    @else
                        <span class="page-link disabled">Далее</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
