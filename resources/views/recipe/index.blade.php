@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')



@section('title')
    Recette | {{ $recipe->title }}
@endsection



@section('content')
    @php
        $recipeImg = $recipe->images[0]->path
    @endphp
    <section id="recipe">
        @if (Session::has('success'))
            <div class="alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="container">
            <h2>{{ $recipe->title }}</h2>

            <div class="top-gallery">

                <span class="stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $recipe->averageRatings())
                            <i class="fa-solid fa-star"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
</span>

                <div class="top-comments">
                    <i class="fa-light fa-comments"></i>
                    <a href="#comments">{{ $recipe->comments->count() }} commentaires</a>
                </div>
            </div>

            <div id="gallery">
                <div class="images-container">
                    <img src="{{ str_contains($recipeImg, 'https') ? $recipeImg : asset('storage/images/'.$recipeImg)}}"
                         alt="{{ $recipe->title }}">
                    <div class="thumbs">
                        @foreach ($recipe->images as $image)
                            <img src="{{ $image->path }}" alt="{{ $image->imageable->title }}">
                        @endforeach
                    </div>
                </div>
            </div>

            <hr>

            <div id="ingredients">
                <h4>Ingrédients</h4>
                <div class="ingredients-container">
                    @foreach ($recipe->ingredients as $ingredient)
                        <div class="ingredient">
                            @foreach ($ingredient->foods as $food)
                                <img src="{{ asset('storage/images/'.$food->image->path) }}" alt="">
                                <p>{{ $ingredient->quantity }} {{ $ingredient->mesure->name }} de <span
                                        class="ingredient-name">{{ $food->name }}</span></p>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>

            <div id="preparation">
                <h4>Préparation</h4>

                <div>
                    <h6>Temps : <span class="time">{{ $recipe->time }}</span></h6>
                    <h6>Difficulté : <span class="time">{{ $recipe->difficulty->name }}</span></h6>
                </div>

                <div id="steps">
                    @foreach($recipe->steps as $key => $step)
                        @php $key++ @endphp
                        <h5 class="step-title">Etape {{ $key }}</h5>
                        <p class="step-content">{{ $step->content }}</p>
                    @endforeach
                </div>
            </div>


        </div>

        <div id="comments">
            <div class="container">

                <h5>Commentaires ({{ $recipe->comments()->count() }})</h5>
                @foreach ($comments as $comment)
                    <div class="comment-body">

                        <div class="user">
                            @if ($comment->user->picture)
                                @php $path = $comment->user->picture @endphp
                                <img
                                    src="{{ str_contains($path, 'http') ? $path : asset('storage/images/'.$path) }}"
                                    alt="">
                            @endif
                            <h6 class="comment-user">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</h6>
                        </div>
                        <p class="comment-content">
                            {{ $comment->content }}
                        </p>
                        <span id="note">
                            Note : {{ $comment->rating }} / 5
                        </span>
                    </div>

                    <hr>

                @endforeach
                {{ $comments->links('pagination.default') }}

            </div>

            @auth()
                @if (Auth::user()->email_verified_at)
                    <section id="add-comment">
                        <div class="container">
                            <h5>Ajouter un commentaire</h5>

                            <form action="{{ route('comments.create') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="comment">Votre commentaire</label>
                                    <textarea class="@error('comment') is-invalid @enderror" id="comment" name="comment"></textarea>
                                    @error('comment') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rating">Note </label>
                                    <select id="rating" name="rating" class="@error('rating') is-invalid @enderror">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    @error('rating') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit">Envoyer</button>

                            </form>
                        </div>

                    </section>

                @else

                    <div class="alert-warning">
                        <div class="container">
                            Vous ne pouvez pas ajouter de commentaires tant que votre compte n'a pas été validé.
                            Veuillez confirmer votre compte en cliquant dans le lien qui vous a été envoyé à votre
                            adresse e-mail : <b>{{ Auth::user()->email }}</b>. <br>
                            Vous pouvez également demander une nouvelle confirmation <a
                                style="text-decoration: underline; font-weight:700"
                                href="{{ route('verification.notice') }}">ici</a>
                        </div>

                    </div>
                @endif

            @endauth


        </div>
        @guest()

            <div class="not-connected">
                <div class="container">
                        <span>Si vous désirez laisser un commentaire, nous vous prions de bien vouloir
                        <a href="{{ route('login') }}">vous connecter</a>.</span>
                </div>
            </div>
        @endguest
    </section>
@endsection

@section('javascript')

    <script>
        const mainImage = document.querySelector('.images-container img')
        const imagesList = document.querySelectorAll('.thumbs img')
        const ratingLabel = document.querySelector('#add-comment label[for="rating"]')
        const selectRating = document.querySelector('select#rating')

        if (ratingLabel) {

            ratingLabel.innerText = "Note 1 / 5"

            const changeRating = (e) => {
                const value = e.target.value
                ratingLabel.innerText = `Note ${value} / 5`
            }

            selectRating.addEventListener('input', changeRating)
        }

        const checkSrc = (images) => {
            images.forEach(image => {
                image.style.opacity = "50%"
                if (image.src === mainImage.src) {
                    image.style.opacity = "100%"
                }
            })
        }

        const changeImage = (images) => {
            images.forEach(image => {
                image.addEventListener('click', function () {
                    mainImage.src = this.src
                    checkSrc(images)
                })
            })

        }
        checkSrc(imagesList)
        changeImage(imagesList)


    </script>

@endsection
