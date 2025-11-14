@extends('layouts.layout')
@section('title', 'Категория')
@section('content')
    <div class="content-row">
        <div class="product_item">

            <a href="{{route('categories.index')}}">Назад</a>
        </div>
        <div class="content_column">
            <div class="text_content">
                <h2>{{$data->title}}</h2>
                <hr>

            </div>
        </div>
    </div>
@endsection
