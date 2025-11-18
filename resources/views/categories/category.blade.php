@extends('layouts.layout')
@section('title', 'Категории')
@section('content')
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('categories.create') }}">Добавить категорию</a>
        @endif
    @endauth

    @if(session()->has('success'))
        <div class="row" style="color: green">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="content-row">
        @foreach($data->categories as $category)
            <div class="product_item">
                <h2>{{ $category->title }}</h2>
                <a href="{{ route('categories.show', $category->id) }}">Просмотр</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('categories.edit', $category->id) }}">Редактировать</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@endsection
