@extends('layouts.layout')
@section('title', 'Авторизация')
@section('content')
    <div class="content">
        <h2>Авторизация</h2>

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

        <form action="{{ route('login') }}" method="post" class="auth-form">
            @csrf

            <div class="form_group">
                <input type="text" name="login" placeholder="Логин" value="{{ old('login') }}">
                @if($errors->has('login'))
                    <span class="error">{{ $errors->first('login') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="password" name="password" placeholder="Пароль">
                @if($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="submit" value="Войти" class="btn-submit">
            </div>
        </form>
    </div>
@endsection
