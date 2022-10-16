@extends('admin.layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card yellow">
                    <i class="fa-solid fa-user yellow card__icon mb-1"></i>
                    <span class="card__content">
                                    <span class="content__count">{{ $users->count() }}</span>
                                    <span class="content__type">Utilisateurs</span>
                                </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card red">
                    <i class="fa-solid fa-pot-food red card__icon mb-1"></i>
                    <span class="card__content">
                                    <span class="content__count">{{ $recipes->count() }}</span>
                                    <span class="content__type">Recettes</span>
                                </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card blue">
                    <i class="fa-solid fa-comment blue card__icon mb-1"></i>
                    <span class="card__content">
                                    <span class="content__count">{{ $comments->count() }}</span>
                                    <span class="content__type">Commentaires</span>
                                </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card orange">
                    <i class="fa-regular fa-can-food orange card__icon mb-1"></i>
                    <span class="card__content">
                                    <span class="content__count">{{ $foods->count() }}</span>
                                    <span class="content__type">Ingrédients</span>
                                </span>
                </div>
            </div>
        </div>
    </div>
@endsection
