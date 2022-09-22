@extends('layout.app')

@section('title')
    Catégorie - {{ ucfirst($recipes[0]->category->name) }}
@endsection

@section('content')
    <div class="container">
        <h1>Recettes - {{ ucfirst($recipes[0]->category->name) }}</h1>

        <div class="recipes">
            @forelse ($recipes as $recipe)
                <div class="recipe">
                    <a href="">
                        <img src="{{ $recipe->images[0]->path }}" alt="{{ $recipe->title }}">
                        <div class="recipe-body">
                            <h3>{{ $recipe->title }}</h3>
                        </div>
                    </a>
                </div>
            @empty
                <p>No recipes</p>
            @endforelse
        </div>
    </div>
@endsection
