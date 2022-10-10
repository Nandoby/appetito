@php use Illuminate\Support\Facades\Session; @endphp
@extends('layout.app')

@section('title') Confirmation de l'inscription @endsection

@section('content')

    <section id="email-verify">
        <div class="container">
            <div class="email-verify">
                Vous avez reçu un e-mail de confirmation à l'adresse suivante : <b>{{ Auth::user()->email }}</b>,
                veuillez cliquer sur le lien de confirmation que vous avez reçu.
            </div>
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit">Envoyer une nouvelle demande</button>
            </form>
            @if (Session::has('message'))
                <span class="verify-resend">{{ Session::get('message') }}</span>
            @endif
        </div>
    </section>

@endsection
