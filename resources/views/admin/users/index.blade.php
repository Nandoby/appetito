@extends('admin.layout.app')

@section('title')
    Utilisateurs
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <h1>Utilisateurs</h1>

        <div class="table-responsive">
            <table data-toggle="table" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date inscription</th>
                <th>Dernière mise à jour</th>
                <th class="text-center">Compte confirmé</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ($user->created_at)->format('d/m/y') }}</td>
                    <td>{{ ($user->updated_at)->format('d/m/y') }}</td>
                    <td class="text-center">{!! $user->email_verified_at ? 'Oui' : '<span class="red">Non</span>' !!}</td>
                    <td>
                        @if (auth()->user() != $user)
                        <div class="btn-group">
                            <a title="Editer" class="btn-sm btn-warning me-2" href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button data-button="delete" data-user="{{ $user->id }}" title="Supprimer" class="btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                            <div class="modal">

                                <div class="modal__content">
                                    <div class="container">
                                        <span class="modal__content__close">&times;</span>
                                        <div class="modal__content__container">
                                            <p class="modal__content__container__p">
                                                Etes-vous certain de vouloir supprimer l'utilisateur'</b>
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

                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            {{ $users->links('pagination.default') }}
        </div>
    </div>
@endsection

@section('javascript')
<script>
    const deleteBtn = document.querySelectorAll('[data-button="delete"]')
    const invalidateBtn = document.querySelector('.buttons__button--not')
    const modal = document.querySelector('.modal')
    const closeBtn = document.querySelector('.modal__content__close')
    const form = document.querySelector('form')
    form.setAttribute('action', '/admin/users/1')
    let userId

    const showModal = (btn) => {
        userId = btn.dataset.user
        modal.style.display = "block"
        form.setAttribute('action', '/admin/users/'+userId )
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
