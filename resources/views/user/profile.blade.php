@extends('layout.app')

@section('title') Mon profil @endsection

@section('content')
    <section id="profile">
        <div class="background-profile" style="background: url('{{ asset('storage/images/background-profile.jpg') }}');background-size:cover;background-position:center"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="leftcolumn">
                        <img class="leftcolumn__image" src="{{ str_contains($user->picture,'http') ? $user->picture : asset('storage/images/'.$user->picture) }}" alt="">
                        <span class="leftcolumn__username">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </span>
                    </div>
                </div>
                <div class="col-md-9">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
