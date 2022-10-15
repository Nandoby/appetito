@extends('layout.app')

@section('title') Mon profil @endsection

@section('content')
    <section id="profile">
        <div class="background-profile" style="background: url('{{ asset('storage/images/background-profile.jpg') }}');background-size:cover;background-position:center"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="leftcolumn">
                        <img class="leftcolumn__image" src="{{ str_contains($user->picture,'http') ? $user->picture : asset('storage/images/'.$user->picture) }}" alt="">
                        <span class="leftcolumn__username">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="rightcolumn">
                        <h1 class="rightcolumn__heading">
                            Mon profil
                        </h1>
                        <div class="informations">
                            <h2 class="informations__heading">
                                Mes informations
                            </h2>
                            <hr>
                            <div class="informations__user">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="informations__user__label">Prénom</span>
                                        <input disabled class="informations__user__input" type="text" value="{{ $user->firstname }}">
                                    </div>
                                    <div class="col-md-6">
                                        <span class="informations__user__label">Nom</span>
                                        <input disabled class="informations__user__input" type="text" value="{{ $user->lastname}}">
                                    </div>
                                    <div class="col-md-6">
                                        <span class="informations__user__label">Adresse e-mail</span>
                                        <input disabled class="informations__user__input" type="text" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <span class="informations__user__label">Inscrit depuis le </span>
                                        <input disabled class="informations__user__input" type="text" value="{{ ($user->email_verified_at)->format('d/m/y') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($user->recipes->count() > 0)
                        <div class="user-recipes">
                            <h2 class="user-recipes__heading">
                                Recettes ajoutées
                            </h2>
                            <div style="overflow-x:auto">
                                <table class="user-recipes__table">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Titre</th>
                                    <th>Temps de préparation</th>
                                    <th>Catégorie</th>
                                    <th>Saison</th>
                                    <th>Difficulté</th>
                                    <th>Commentaires</th>
                                    <th>Note moyenne</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($user->recipes as $recipe)
                                    <tr>
                                        <td class="id">{{ $recipe->id }}</td>
                                        <td><a class="table__link" href="{{ route('recipes.index',['slug' => $recipe->slug]) }}">{{ $recipe->title }}</a></td>
                                        <td>{{ $recipe->time }}</td>
                                        <td>{{ $recipe->category->name }}</td>
                                        <td>{{ $recipe->season->name }}</td>
                                        <td>{{ $recipe->difficulty->name }}</td>
                                        <td>{{ $recipe->comments->count() }}</td>
                                        <td>{{ (int)$recipe->averageRatings() }} / 5</td>
                                        <td>
                                            <a href="{{ route('recipe.edit', ['id' => $recipe->id]) }}" title="Editer" class="table__button__edit recipe-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <button data-recipe="{{ $recipe->id }}" title="Supprimer" class="table__button__delete recipe-delete"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="deleteModal" class="modal">

            <div class="modal__content">
                <div class="container">
                    <span class="modal__content__close">&times;</span>
                    <div class="modal__content__container">
                        <p class="modal__content__container__p">
                            Etes-vous certain de vouloir supprimer la recette ?</b>
                        </p>
                        <div class="modal__content__container__buttons">
                            <button class="buttons__button--confirm">Oui</button>
                            <button class="buttons__button--not" >Non</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@section('javascript')
<script>
    const modal = document.getElementById('deleteModal')
    const buttonDelete = document.querySelectorAll('.recipe-delete')
    const close = document.querySelector('.modal__content__close')
    const buttonNot = document.querySelector('.buttons__button--not')
    const buttonConfirm = document.querySelector('.buttons__button--confirm');
    const table = document.querySelector('table')
    let recipeID

    const showModal = (btn) => {
        modal.style.display = "block"
        recipeID = btn.dataset.recipe
    }

    const hideModal = () => {
        modal.style.display = "none"
    }

    const deleteRecipe = (e) => {

        e.preventDefault()
        hideModal()

        fetch('/recipe/delete', {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                recipe: recipeID
            })
        })
            .then(response => response.json())
            .then (data => {

                // Si on modifie l'id de la recette et qu'on n'est pas le propriétaire
                // on effectue une redirection en javascript
                if (data == "owner") {
                    window.location.href = '{{ route('home') }}'
                } else {

                    const row = document.querySelector('.id')
                    row.parentNode.remove()

                    const div = document.createElement('div')
                    div.classList.add('alert-success', 'mb-3')
                    div.innerHTML = `La recette <b>&laquo; ${data.recipe.title} &raquo;</b> a bien été supprimée`
                    table.insertAdjacentElement('beforebegin', div)
                }
            })

    }

    buttonDelete.forEach(button => {
        button.addEventListener('click', () => showModal(button))

    })

    close.addEventListener('click', hideModal)

    buttonNot.addEventListener('click', hideModal)

    buttonConfirm.addEventListener('click', deleteRecipe)




</script>
@endsection
