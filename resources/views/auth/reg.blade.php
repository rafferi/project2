@extends('layouts.layout')
@section('title', 'Регистрация')
@section('content')
    <div class="content">
        <h2>Регистрация</h2>

        @if(session()->has('success'))
            <div class="alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <form action="{{ route('signup') }}" method="post" class="auth-form">
            @csrf

            <div class="form_group">
                <input type="text" name="firstname" placeholder="Имя" value="{{ old('firstname') }}">
                @if($errors->has('firstname'))
                    <span class="error">{{ $errors->first('firstname') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="lastname" placeholder="Фамилия" value="{{ old('lastname') }}">
                @if($errors->has('lastname'))
                    <span class="error">{{ $errors->first('lastname') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="patronymic" placeholder="Отчество" value="{{ old('patronymic') }}">
                @if($errors->has('patronymic'))
                    <span class="error">{{ $errors->first('patronymic') }}</span>
                @endif
            </div>

            <div class="form_group">
                Пол:<br>
                <input type="radio" name="gender" value="male"> Мужской
                <input type="radio" name="gender" value="female"> Женский
                @if($errors->has('gender'))
                    <span class="error">{{ $errors->first('gender') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form_group">
                <input type="text" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                    <span class="error">{{ $errors->first('phone') }}</span>
                @endif
            </div>

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
                <input type="submit" value="Зарегистрироваться" class="btn-submit">
            </div>
        </form>
    </div>
@endsection
