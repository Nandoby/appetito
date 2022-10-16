@extends('admin.layout.app')

@section('title')
    Edition de {{ $food->name }}
@endsection

@section('content')

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <h4 class="mt-4">Edition de {{ $food->name }}</h4>

        <form action="{{ route('admin.ingredients.update', ['food' => $food->id]) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $food->name }}" />
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.ingredients.index')}}" class="btn btn-secondary me-2">Retour</a>
                <button class="btn btn-success" type="submit">Modifer</button>
            </div>

        </form>
    </div>
@endsection
