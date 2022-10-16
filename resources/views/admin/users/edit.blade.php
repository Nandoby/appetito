@extends('admin.layout.app')

@section('title')
    Edition de {{ $user->firstname }} {{ $user->lastname }}
@endsection

@section('content')

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <h4 class="mt-4">Edition de {{ $user->firstname }} {{ $user->lastname }}</h4>

        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" />
                    @error('firstname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" />
                </div>
                <div class="col-12 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" />
                </div>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.users.index')}}" class="btn btn-secondary me-2">Retour</a>
                <button class="btn btn-success" type="submit">Modifer</button>
            </div>

        </form>
    </div>
@endsection
