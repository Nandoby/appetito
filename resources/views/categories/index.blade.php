@extends('layout.app')

@section('title')
    Catégories
@endsection

@section('content')
    <div class="container">
        <h1>Recettes par Catégorie</h1>
        <p>
            Des milliers de recettes à essayer ! Mais par où commencer ? Pour vous aider à vous y retrouver, nous avons
            rangé les recettes par catégorie.
        </p>

        <div class="cards-cat">
            @foreach ($categories as $category)
            <div class="card">
                <h3>{{ ucfirst($category->name) }}</h3>
                <img src="{{ asset('storage/images/'.$category->images->path)  }}" alt="">
                <a class="button" href="#">Voir {{ $category->name }}</a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
