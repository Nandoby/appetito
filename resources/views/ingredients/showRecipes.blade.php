@extends('layout.app')

@section('title')
@endsection

@section('content')
    <section id="recipesByIngredient">
        <div class="container">

            <div class="recipes-container">
                @forelse ($recipes as $recipe)
                    <a class="recipe" href="{{ route('recipes.index', ['slug' => $recipe->slug]) }}">
                        <img src="{{ $recipe->images[0]->path }}" alt="">
                        <div class="recipe-title">{{ $recipe->title }}</div>
                    </a>
                @empty
                    <span class="error">Aucune recette trouvée en rapport avec l'ingrédient <b>&laquo; {{ $ingredient->name }} &raquo;</b></span>
                @endforelse
            </div>
        </div>
    </section>

@endsection
