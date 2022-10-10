@extends('layout.app')

@section('title')
    Login
@endsection

@section('content')
    <section id="login">
        <div class="container">
            <div class="login-card">
                <img src="{{ asset('storage/images/login-background.jpg') }}" alt="">
                <div class="login-body">
                    <h4>Connexion</h4>
                    <form method="POST" action="{{ route('login.authenticate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
                            @error('email') <span class="error">{{ $message }} </span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password">Password</label>
                            <input class="@error('password')is-invalid @enderror" type="password" id="password" name="password">
                            @error('password')  <span class="error">{{ $message }} </span> @enderror
                        </div>
                        <button type="submit">Connexion</button>
                        @error('errorLogin') <div class="errorLogin">{{ $message }}</div> @enderror
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
