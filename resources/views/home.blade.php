@extends('layout.app')

@section('title')
    Accueil
@endsection

@section('content')
    <!-- Gallery -->
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @foreach ($recipes as $recipe)
                    @foreach ($recipe->images as $images)
                        <li class="glide__slide">
                            <img src="{{ $images->path }}" alt="">
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i
                    class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="glide__bullets" data-glide-el="controls[nav]">
            @foreach ( $recipes as $recipe )
                @for ( $i = 0; $i < count($recipe->images); $i++ )
                    <button class="glide__bullet" data-glide-dir="=0"></button>
                @endfor
            @endforeach
        </div>
    </div>
    <!-- End Gallery-->

    <!-- Category Choice -->
    <section id="categories">
        <div class="container">
            <ul>
                <li>
                    <a href="http://127.0.0.1:8000/categories/apéritif">
                        <img src={{asset("icons/apero.svg")}} alt="Apéro">
                        <h4>Apéritifs</h4>
                    </a>
                </li>
                <li>
                    <a href="http://127.0.0.1:8000/categories/entrée">
                        <img src={{asset("icons/entree.svg")}} alt="Entrée">
                        <h4>Entrées</h4>
                    </a>
                </li>
                <li>
                    <a href="http://127.0.0.1:8000/categories/apéritif">
                        <img src={{asset("icons/plat.svg")}} alt="Plat">
                        <h4>Plats</h4>
                    </a>
                </li>
                <li>
                    <a href="http://127.0.0.1:8000/categories/dessert">
                        <img src={{asset("icons/dessert.svg")}} alt="Dessert">
                        <h4>Desserts</h4>
                    </a>
                </li>
                <li>
                    <a href="http://127.0.0.1:8000/categories/fromages">
                        <img src={{asset("icons/fromage.svg")}} alt="Fromage">
                        <h4>Fromages</h4>
                    </a>
                </li>
                <li>
                    <a href="http://127.0.0.1:8000/categories/fruits">
                        <img src={{ asset("icons/fruit.svg") }} alt="Fruit">
                        <h4>Fruits</h4>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Category Choice -->

    <!-- Last Recipes -->
    <section id="last-recipes">
        <div class="container">

            <h2 class="head-cursive">Dernières recettes</h2>

            <div class="cards">


                @foreach ($lastRecipes as $recipe)
                    <div class="card">
                        <a href="#">
                            <div class="card-img-container">
                                <img class="card-img" src="{{ $recipe->images->first()->path }}" alt="recette">
                            </div>
                            <div class="card-body">
                                <h6>{{ $recipe->category->name }}</h6>
                                <h5>{{ $recipe->title }}</h5>
                                <div class="card-infos">
                                    <div>
                                        <img src="{{ asset('icons/cookshat.svg') }}" alt="Cook's hat icon">
                                        <span>{{ $recipe->difficulty->name }}</span>
                                    </div>
                                    <div>
                                        <img src="{{ asset('icons/clock.svg') }}" alt="Clock icon">
                                        <span>{{$recipe->time}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>

    </section>
    <!-- End Last Recipes -->

    <!-- Top Rated Section-->
    <section id="top-rated">
        <div class="container">
            <h2 class="head-cursive">Les mieux notées</h2>
            <div class="cards">
                @foreach ($topRated as $recipe)
                <div class="card">
                    <a href="#">
                        <div class="card-img-container">
                            <img class="card-img" src="{{ $recipe->images->first()->path }}" alt="recette">
                        </div>
                        <div class="card-body">
                            <h6>{{ $recipe->category->name }}</h6>
                            <h5>{{ $recipe->title }}</h5>
                            <div class="card-infos">
                                <div>
                                    <img src="{{ asset('icons/cookshat.svg') }}" alt="Cook's hat icon">
                                    <span>{{ $recipe->difficulty->name }}</span>
                                </div>
                                <div>
                                    <img src="{{ asset('icons/clock.svg') }}" alt="Clock icon">
                                    <span>{{$recipe->time}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Top Rated Section -->
@endsection

@section('javascript')

@endsection
