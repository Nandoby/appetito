@extends('layout.app')

@section('title')
    Catégorie - {{ ucfirst($cat->name) }}
@endsection


@section('content')
    <div class="container">
        <h1>Recettes - {{ ucfirst($cat->name) }}</h1>

        <div class="recipes">
            @forelse ($recipes as $recipe)
                <div class="recipe">
                    <a href="{{ route('recipes.index', ['recipe' => $recipe->slug ]) }}">
                        <img src="{{ $recipe->images[0]->path }}" alt="{{ $recipe->title }}">
                        <h5>{{ $recipe->title }}</h5>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $recipe->averageRatings())
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                            <span>sur {{ $recipe->comments->count() }} avis</span>
                        </div>
                    </a>
                </div>
            @empty
                <p class="error">
                    Aucune recette trouvée pour la catégorie <b>{{ $cat->name }}</b>
                </p>
            @endforelse
        </div>
    </div>
@endsection
