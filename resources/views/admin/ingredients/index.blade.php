@extends('admin.layout.app')

@section('title')
    Ingrédients
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <h1>Ingrédients</h1>

        <div class="table-responsive">
            <table data-toggle="table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($foods as $food)
                    <tr>
                        <td>{{ $food->id }}</td>
                        <td>{{ $food->name }}</td>
                        <td>
                            <img width="40" height="40" src="{{ asset('/storage/images/'.$food->image->path) }}" />
                        </td>
                        <td>{{ ($food->created_at)->format('d/m/y') }}</td>
                        <td>{{ ($food->updated_at)->format('d/m/y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a title="Editer" href="{{ route('admin.ingredients.edit', ['food' => $food->id]) }}" class="btn-sm btn-warning me-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button data-button="delete" data-food="{{ $food->id }}" title="Supprimer" class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $foods->links('pagination.default') }}

            <div class="modal">

                <div class="modal__content">
                    <div class="container">
                        <span class="modal__content__close">&times;</span>
                        <div class="modal__content__container">
                            <p class="modal__content__container__p">
                                Etes-vous certain de vouloir supprimer l'ingredient ?
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
        let foodID

        const showModal = (btn) => {
            foodID = btn.dataset.food
            modal.style.display = "block"
            form.setAttribute('action', '/admin/ingredients/'+foodID )
        }

        const hideModal = () => {
            modal.style.display = "none"
        }

        deleteBtn.forEach(button => {
            button.addEventListener('click', () => showModal(button))

        })

        closeBtn.addEventListener('click', hideModal)
        invalidateBtn.addEventListener('click', hideModal)


    </script>
@endsection
