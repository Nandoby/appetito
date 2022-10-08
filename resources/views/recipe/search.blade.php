@extends('layout.app')

@section('title') Recettes @endsection

@section('content')
    <div class="container">
        <div class="recipes">
            @forelse($recipes as $recipe)
                <div class="recipe">
                    <a href="{{ route('recipes.index', ['slug' => $recipe->slug]) }}">
                        <img src="{{ $recipe->images[0]->path }}" alt="{{ $recipe->title }}">
                        <h5>{{ $recipe->title }}</h5>
                        <span class="stars">
                             @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $recipe->averageRatings())
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                            <span>sur {{ $recipe->comments->count() }} avis</span>
                        </span>
                    </a>
                </div>
                @empty
                    <p class="error">
                        Aucune recette trouvée pour la recherche <b>&laquo; {{ $request->input('recipe') }} &raquo;</b>.
                        Veuillez essayer un autre terme
                    </p>
            @endforelse
        </div>
    </div>

@endsection
