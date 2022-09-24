@extends('layout.app')

@section('title')
    Ingrédients
@endsection

@section('content')
    <section id="ingredients">
        <div class="container">
            <h1>Index des ingrédients</h1>
            <div class="alpha-container">
                @foreach(range('a', 'z') as $i)
                    <div>
                            @if ($i == $letter)
                                <a href="{{ route('ingredients.show', ['letter' => $i]) }}"
                                   class="alpha-active">{{ $i }}</a>
                            @else
                                <a href="{{ route('ingredients.show', ['letter' => $i]) }}">{{ $i }}</a>
                            @endif
                    </div>
                @endforeach
            </div>
            <div id="alpha-content">
                @forelse ($ingredients as $ingredient)
                    <div class="ingredient">
                        <a href="#">
                            <img src="{{ asset('storage/images/' . $ingredient->image->path) }}" alt="{{ $ingredient->name }}">
                            <span>{{ $ingredient->name }}</span>
                        </a>
                    </div>
                @empty
                    <p class="error">Aucun ingrédient commençant par <b>&laquo; {{ $letter }} &raquo;</b></p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
