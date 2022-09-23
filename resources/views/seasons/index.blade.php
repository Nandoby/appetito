@extends('layout.app')

@section('title')
    Saisons
@endsection

@section('content')
    <div class="container">
        <h1>Recettes par Saison</h1>
        <p>
            Des milliers de recettes à essayer ! Mais par où commencer ? Pour vous aider à vous y retrouver, nous avons
            rangé les recettes par saison.
        </p>
        <div class="cards-cat">

            @foreach ($seasons as $season)
                <div class="card">
                    <h3>{{ str_replace("été", "Eté", ucfirst($season->name)) }}</h3>
                    <img src="{{ asset('storage/images/'.$season->image->path) }}" alt="">
                    <a class="button"
                       href="{{ route('seasons.show', ['saison' => $season->name]) }}">Recettes {{ $season->name }}</a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
