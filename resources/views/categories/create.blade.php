@extends('layouts.layout')
@section('title', 'Добавление категории')
@section('content')
    <div class="content">
        <h2>Добавление категории</h2>


        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
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

        <form action="{{ route('categories.store') }}" method="post">
@csrf
            <div class="form_group">
                <input type="text" name="title" placeholder="Введите название категории" value="{{ old('title') }}"
                       class="{{ $errors->has('title') ? 'error-border' : '' }}">
                @if($errors->has('title'))
                    <span class="error">{{ $errors->first('title') }}</span>
                @endif
            </div>


            <div class="form_group">
                <input type="submit" value="Добавить категорию">
            </div>
        </form>
    </div>
@endsection
