
@extends('layout.app')



@section('title')
    Recette | {{ $recipe->title }}
@endsection



@section('content')
    @php
        $recipeImg = $recipe->images[0]->path
    @endphp
    <section id="recipe">
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

                <h5>Commentaires ({{ $recipe->comments->count() }})</h5>
                @foreach ($recipe->comments as $comment)
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

            </div>

            @auth()
                Veuillez vous connecter
            @endauth


        </div>
        @guest()
            <div class="not-connected">
                <div class="container">
                    <span>Si vous désirez laisser un commentaire, nous vous prions de bien vouloir
                    <a href="#">vous connecter</a>.</span>
                </div>
            </div>
        @endguest
    </section>
@endsection

@section('javascript')

    <script>
        const mainImage = document.querySelector('.images-container img')
        const imagesList = document.querySelectorAll('.thumbs img')

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
