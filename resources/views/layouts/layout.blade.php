<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проект </title>
    <title>Shop | @yield('title', 'home')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <header>
            <h2>
                Название проекта
            </h2>
        </header>
        <nav class="navigation">
            <ul>

                <li><a href="/info">О нас</a></li>
                <li><a href="/contact">Контакты</a></li>
                <li><a href="/products">Товары</a></li>

                <li><a href="/categories">Категории</a></li>

                @guest()
                    <li><a href="/signup">Регистрация</a></li>
                    <li><a href="/login">Вход</a></li>
                @endguest
                @auth()
                    <li>
                        <a href="{{ route('favorites.index') }}" title="Избранное">
                            <img src="{{ asset('images/icons/favorites.png') }}" alt="Избранное" class="nav-icon">
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" title="Корзина">
                            <img src="{{ asset('images/icons/cart_index.png') }}" alt="Корзина" class="nav-icon">
                        </a>
                    </li>
                    <li><a href="/logout">Выход</a></li>
                @endauth
            </ul>
        </nav>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="content-row">
            <div>
                <p>
                    2025 &copy;, Магнитогорск
                </p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
