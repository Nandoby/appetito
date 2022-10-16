@php
$user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("favicon-32x32.png") }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("favicon-16x16.png") }}">
    <link rel="icon" href="{{ asset("favicon.ico") }}">
    <title>Appetito | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @yield('stylesheet')
    @vite('resources/scss/app.scss')
</head>
<body>
<section id="admin">
    <div class="row">
        <div class="left-column col-lg-2">
            <div class="container">
                <h2 class="left-column__heading">Appetito</h2>
                <div class="admin-profile">
                    <img src="{{ asset('/storage/images/'.$user->picture) }}" class="admin-profile__picture">
                    <span class="admin-profile__user">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </span>
                </div>
            </div>

            <ul class="navigation">
                <li class="navigation__item">
                    <i class="fa-solid fa-gauge indigo"></i>
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="navigation__item">
                    <i class="fa-solid fa-user yellow"></i>
                    <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
                </li>
                <li class="navigation__item">
                    <i class="fa-solid fa-pot-food red"></i>
                    <a href="{{ route('admin.recipes.index') }}">Recettes</a>
                </li>
                <li class="navigation__item">
                    <i class="fa-regular fa-can-food orange"></i>
                    <a href="{{ route('admin.ingredients.index') }}">Ingrédients</a>
                </li>
            </ul>
        </div>

        <div class="right-column col-lg-10">
            @yield('content')

        </div>
    </div>
</section>


@vite('resources/js/app.js')
@yield('javascript')
</body>
</html>
