@extends('layout.app')

@section('title') Saison - {{ ucfirst($season->name) }} @endsection

@section('content')
    <div class="container">
        <h1>Recettes par Saison - {{ ucfirst($season->name) }}</h1>

        <div class="recipes">
            @forelse ($season->recipes as $recipe)
                <div class="recipe">
                    <a href="{{ route('recipes.index', [ 'slug' => $recipe->slug ] ) }}">
                        <img src="{{ str_contains($recipe->images[0]->path,'http') ? $recipe->images->first()->path : asset('storage/images/'.$recipe->images->first()->path) }}" alt="{{ $recipe->title }}">
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
                    Aucune recette trouvée pour la saison <b>{{ $season->name }}</b>
                </p>
            @endforelse
        </div>
    </div>
@endsection
