@extends('layouts.layout')
@section('title', 'Редактирование товара')
@section('content')
    <div class="content product-form">
        <h2>Редактирование товара</h2>

        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <form action="{{ route('products.update' , $pro) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form_group">
                <input type="text" name="name" placeholder="Введите название" value="{{ $pro->name }}"
                       class="{{ $errors->has('name') ? 'error-border' : '' }}">
                @if($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="price" placeholder="Введите цену" value="{{ $pro->price }}"
                       class="{{ $errors->has('price') ? 'error-border' : '' }}">
                @if($errors->has('price'))
                    <span class="error">{{ $errors->first('price') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="description" placeholder="Введите описание" value="{{ $pro->description }}"
                       class="{{ $errors->has('description') ? 'error-border' : '' }}">
                @if($errors->has('description'))
                    <span class="error">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="qty" placeholder="Введите количество" value="{{ $pro->qty }}"
                       class="{{ $errors->has('qty') ? 'error-border' : '' }}">
                @if($errors->has('qty'))
                    <span class="error">{{ $errors->first('qty') }}</span>
                @endif
            </div>

            <div class="form_group">
                <select name="category_id" class="{{ $errors->has('category_id') ? 'error-border' : '' }}">
                    <option disabled selected>Выберите категорию</option>
                    @foreach($category as $categ)
                        <option value="{{ $categ->id }}" {{ $pro->category_id == $categ->id ? 'selected' : '' }}>
                            {{ $categ->title }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <span class="error">{{ $errors->first('category_id') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="file" name="image" class="{{ $errors->has('image') ? 'error-border' : '' }}">
                @if($errors->has('image'))
                    <span class="error">{{ $errors->first('image') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="submit" value="Редактировать товар">
            </div>
        </form>
    </div>
@endsection
