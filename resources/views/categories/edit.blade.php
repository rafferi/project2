@extends('layouts.layout')
@section('title', 'Редактирование категории')
@section('content')
    <div class="content">
        <h2>Редактирование категории</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form_group">
                <input type="text" name="title" value="{{ old('title', $category->title) }}" placeholder="Название">
                @error('title')<span class="error">{{ $message }}</span>@enderror
            </div>



            <div class="form_group">
                <button type="submit">Сохранить</button>
                <a href="{{ route('categories.index') }}">Отмена</a>
            </div>
        </form>
    </div>
@endsection
