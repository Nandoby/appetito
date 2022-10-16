@extends('admin.layout.app')

@section('title')
    Recettes
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <h1>Recettes</h1>

        <div class="table-responsive">
            <table data-toggle="table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Temps de préparation</th>
                    <th>Catégorie</th>
                    <th>Difficulté</th>
                    <th>Saison</th>
                    <th>Créateur</th>
                    <th>Commentaires</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->id }}</td>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->time }}</td>
                        <td>{{ $recipe->category->name }}</td>
                        <td>{{ $recipe->difficulty->name }}</td>
                        <td>{{ $recipe->season->name }}</td>
                        <td>{{ $recipe->user->lastname }} {{ $recipe->user->firstname[0] }}.</td>
                        <td class="text-center"><span class="badge bg-black">{{ $recipe->comments->count() }}</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                               <button data-button="delete" data-recipe="{{ $recipe->id }}" type="button" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $recipes->links('pagination.default') }}

            <div class="modal">

                <div class="modal__content">
                    <div class="container">
                        <span class="modal__content__close">&times;</span>
                        <div class="modal__content__container">
                            <p class="modal__content__container__p">
                                Etes-vous certain de vouloir supprimer la recette ?
                            </p>
                            <div class="modal__content__container__buttons">
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="buttons__button--confirm">Oui</button>
                                    <button type="button" class="buttons__button--not" >Non</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const deleteBtn = document.querySelectorAll('[data-button="delete"]')
        const invalidateBtn = document.querySelector('.buttons__button--not')
        const closeBtn = document.querySelector('.modal__content__close')
        const modal = document.querySelector('.modal')
        const form = document.querySelector('form')
        let recipeID

        const showModal = (btn) => {
            recipeID = btn.dataset.recipe
            modal.style.display = "block"
            form.setAttribute('action', '/admin/recipes/'+recipeID )
        }

        const hideModal = () => {
            modal.style.display = "none"
        }

        deleteBtn.forEach(button => {
            button.addEventListener('click', () => showModal(button))

        })

        invalidateBtn.addEventListener('click', hideModal)
        closeBtn.addEventListener('click', hideModal)

    </script>
@endsection
