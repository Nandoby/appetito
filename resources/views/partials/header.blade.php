@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Route; @endphp
<header class="p-6">
    <div class="container">

        <nav>
            <div id="brand">
                <span class="text-logo">Appetito</span>
                <a href="/"><img src="{{ asset('icons/logo.svg') }}" alt="" class="logo"></a>
            </div>
            <form action="{{ route('recipes.search') }}" method="GET">
                <input autocomplete="off" type="search" name="recipe"
                       placeholder="Recherche des recettes ou ingrédients ..."
                       value="{{ isset($request) ? $request->input('recipe') : '' }}"/>
                <button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
            </form>
            <ul id="auth">
                @guest()
                    <li><a class="animate" href="{{ route('login') }}">Connexion</a></li>
                    <li><a class="animate" href="{{ route('register') }}">Inscription</a></li>
                @endguest
                @auth()
                    <li class="auth">
                        <img class="picture"
                             src="{{ str_contains(Auth::user()->picture, 'http') ? Auth::user()->picture : asset('storage/images/'.Auth::user()->picture) }}">
                        <i class="profile-chevron fa-regular fa-chevron-down"></i>
                        <span class="ml-2">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                        <ul class="submenu">
                            <li><a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i>Voir profil</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i>
                                    Déconnexion</a></li>

                        </ul>
                    </li>
                @endauth()
            </ul>
            <i id="menu-bars" class="fa-solid fa-bars"></i>
        </nav>
    </div>
</header>

<div id="media-menu">
    <div class="container">
        <span class="close-button">
            <i class="fa-solid fa-xmark"></i>
        </span>

        <ul id="auth-media">
            @guest()
                <li class="auth-media__link"><a href="{{ route('login') }}"><i class="fa-regular fa-user-lock"></i>Connexion</a></li>
                <li class="auth-media__link"><a href="{{ route('register') }}"><i class="fa-solid fa-pen-to-square"></i>Inscription</a></li>

            @endguest
            @auth()
                <li class="auth">
                    <img class="picture"
                         src="{{ str_contains(Auth::user()->picture, 'http') ? Auth::user()->picture : asset('storage/images/'.Auth::user()->picture) }}">
                    <span class="ml-2 mt-2">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                    <ul>
                        <li><a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i>Voir profil</a></li>
                        <li><a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i>
                                Déconnexion</a></li>

                    </ul>
                </li>
            @endauth
        </ul>
        <form action="{{ route('recipes.search') }}" method="GET">
            <input autocomplete="off" type="search" name="recipe"
                   placeholder="Recherche des recettes ou ingrédients ..."
                   value="{{ isset($request) ? $request->input('recipe') : '' }}"/>
            <button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
        </form>
    </div>

</div>

<div id="nav-secondary">
    <nav>
        <div class="container">
            <ul>
                <li class="mr-4">
                    <a href="/"><i class="fa-solid fa-house icon-color mr-1"></i> <span>Accueil</span></a>
                </li>
                <li class="mr-4">
                    <a href="#"><i class="fa-solid fa-book-open icon-color mr-1"></i><span>Recettes</span></a><i
                        class="fa-solid fa-chevron-down text-red ml-2"></i>
                    <ul>
                        <li><a href="{{ route('categories.index') }}">Par Catégorie</a></li>
                        <li><a href="{{ route('seasons.index') }}">Par Saison</a></li>
                        <li><a href="{{ route('recipe.create') }}" class="btn btn-primary">Proposer une recette</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-carrot icon-color mr-1"></i><span>Ingrédients</span></a><i
                        class="fa-solid fa-chevron-down text-red ml-2"></i>
                    <ul>
                        <li><a href="{{ route('ingredients.index') }}">Par ordre alphabétique</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
