@extends('layout.app')

@section('title') Edition de {{ $recipe->title }}@endsection

@section('content')
    <section id="edit-recipe">
        <div class="background-profile" style="background: url('{{ asset('storage/images/background-profile.jpg') }}');background-size:cover;background-position:center"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="leftcolumn">
                        <img class="leftcolumn__image" src="{{ str_contains($recipe->user->picture,'http') ? $recipe->user->picture : asset('storage/images/'.$recipe->user->picture) }}" alt="">
                        <span class="leftcolumn__username">
                            {{ $recipe->user->firstname }} {{ $recipe->user->lastname }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <h4 class="mb-3 mt-3">Edition de la recette &laquo; {{ $recipe->title }} &raquo;</h4>
                    <form class="form-recipe-edit" method="POST" action="{{ route('recipe.editStore') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-recipe-edit__label" for="title">Titre</label>
                                <input class="form-recipe-edit__input" type="text" id="title" name="title" value="{{ $recipe->title }}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-recipe-edit__label" for="time">Temps de préparation</label>
                                <input class="form-recipe-edit__input" type="time" id="time" name="time" value="{{ $recipe->timeEdit() }}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-recipe-edit__label" for="category">Catégories</label>
                                <select class="form-recipe-edit__select" id="category" name="category">
                                    @foreach ($categories as $category)
                                        <option @selected($recipe->category->id == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-recipe-edit__label" for="difficulty">Difficulté</label>
                                <select class="form-recipe-edit__select" id="difficulty" name="difficulty">
                                    @foreach ($difficulties as $difficulty)
                                        <option @selected($recipe->difficulty->id == $difficulty->id) value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-recipe-edit__label" for="season">Saison</label>
                                <select class="form-recipe-edit__select" id="season" name="season">
                                    @foreach ($seasons as $season)
                                        <option @selected($recipe->season->id == $season->id) value="{{ $season->id }}">{{ $season->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h5 class="form-recipe-edit__heading">
                                Ingrédients
                            </h5>
                            @foreach ($recipe->ingredients as $key => $ingredient)
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="{{ 'food-'.$key+1 }}" class="form-recipe-edit__label">Aliment</label>
                                            <select class="form-recipe-edit__select" name="foods[]" id="{{ 'food-'.$key+1 }}">
                                                @foreach ($foods as $food)
                                                    @foreach ($ingredient->foods as $ing)
                                                        <option @selected($food->id == $ing->id) value="{{ $food->id }}">{{ $food->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="quantity" class="form-recipe-edit__label">Quantité</label>
                                            <input type="number" id="quantity" name="quantity[]" class="form-recipe-edit__input" value="{{ $ingredient->quantity }}" >
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="mesure" class="form-recipe-edit__label">Mesure</label>
                                            <select class="form-recipe-edit__select" name="mesure[]">
                                                @foreach ($mesures as $mesure)
                                                    <option @selected($mesure->id == $ingredient->mesure->id) value="{{ $mesure->id }}">{{ $mesure->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <h5 class="form-recipe-edit__heading">
                                Etapes
                            </h5>
                            @foreach ($recipe->steps as $key => $step)
                                <div class="col-12 mb-3">
                                    <label for="{{ 'step-'.$key + 1 }}" class="form-recipe-edit__label">Etape {{ $key + 1}}</label>
                                    <textarea class="form-recipe-edit__textarea" id="{{ 'step-'.$key+1 }}" name="steps[]">{{ $step->content }}</textarea>
                                </div>
                            @endforeach


                        </div>
                        <a class="form-recipe-edit__link" href="{{ route('profile') }}">Retour</a>
                        <button class="form-recipe-edit__submit" type="submit">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


