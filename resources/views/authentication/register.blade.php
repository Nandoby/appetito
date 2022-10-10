@extends('layout.app')

@section('title')
    Inscription
@endsection

@section('content')
    <section id="login">
        <div class="container">
            <div class="login-card">
                <img src="{{ asset('storage/images/register-background.jpg') }}" alt="">
                <div class="login-body">
                    <h4>Inscription</h4>
                    <form method="POST" action="{{ route('register.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="first-name">Prénom</label>
                            <input class="@error('firstName') is-invalid @enderror" type="text" id="first-name" name="firstName" value="{{ old('firstName') }}" />
                            @error('firstName') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last-name">Nom</label>
                            <input class="@error('lastName') is-invalid @enderror" type="text" id="last-name" name="lastName" value="{{ old('lastName') }}" />
                            @error('lastName') <span class="error">{{ $message }}</span> @enderror

                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
                            @error('email') <span class="error">{{ $message }} </span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input class="@error('password')is-invalid @enderror" type="password" id="password" name="password">
                            @error('password')  <span class="error">{{ $message }} </span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm">Confirmation du mot de passe</label>
                            <input class="@error('password')is-invalid @enderror" type="password" id="password-confirm" name="passwordConfirm">
                            @error('passwordConfirm')  <span class="error">{{ $message }} </span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="picture">Avatar</label>
                            <input class="@error('picture')is-invalid @enderror" type="file" id="picture" name="picture" />
                            <span class="info">* Si aucun avatar n'est uploadé, un avatar par défaut sera attribué</span>
                        </div>
                        <button type="submit">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
