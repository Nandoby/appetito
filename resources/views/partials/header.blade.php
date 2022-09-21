@php use Illuminate\Support\Facades\Route; @endphp
<header class="p-6">
    <div class="container">

        <nav>
            <div id="brand">
                <span class="text-logo">Appetito</span>
                <a href="/"><img src="{{ asset('icons/logo.svg') }}" alt="" class="logo"></a>
            </div>
            <form>
                <input type="search" placeholder="Recherche des recettes ou ingrédients ..."/>
            </form>
            <ul id="auth">
                <li><a class="mr-4 animate" href="#">Connexion</a></li>
                <li><a class="mr-4 animate" href="#">Inscription</a></li>
                <li><a class="flag" href="#"><img src="{{ asset("icons/flag-FR.svg") }}" alt="Français"></a></li>
                <li><a class="ml-4 flag" href="#"><img src={{ asset("icons/flag-IT.svg") }} alt="Italiano"></a></li>
            </ul>
            <i id="menu-bars" class="fa-solid fa-bars"></i>
        </nav>
    </div>
</header>
<div id="nav-secondary">
    <nav>
        <div class="container">
            <ul>
                <li class="mr-4">
                    <a class="animate {{ Route::is('home') ? 'active' : '' }}" href="/">Accueil</a>
                </li>
                <li class="mr-4">
                    <a class="mr-2" href="#">Recettes</a><i class="fa-solid fa-chevron-down text-red"></i>
                    <ul>
                        <li><a href="{{ route('categories.index') }}">Par Catégorie</a></li>
                        <li><a href="{{ route('seasons.index') }}">Par Saison</a></li>
                        <li><a href="#" class="btn btn-primary">Proposer une recette</a></li>
                    </ul>
                </li>
                <li>
                    <a class="mr-2" href="">Ingrédients</a><i class="fa-solid fa-chevron-down text-red"></i>
                    <ul>
                        <li><a href="#">Par ordre alphabétique</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
