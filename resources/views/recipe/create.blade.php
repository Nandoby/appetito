@extends('layout.app')

@section('title')
    Création recette
@endsection

@section('content')
    <section id="recipe-create">
        <div class="container">
            <h1>Ajouter une recette</h1>

            <form action="" method="POST">

                <!-- Step 1 -->
                <div data-step="1">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title"/>
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="time">Temps de préparation</label>
                                <input type="time" name="time">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category">Catégorie</label>
                                <select id="category" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="difficulty">Difficulté</label>
                                <select id="difficulty" name="difficulty">
                                    @foreach($difficulties as $difficulty)
                                        <option value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                                    @endforeach
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- End Step 1 -->

                <!-- Step 2 -->
                <div data-step="2">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="season">Saison</label>
                                <select id="season" name="season" id="season">
                                    @foreach($seasons as $season)
                                        <option value="{{ $season->id }}">{{ $season->name }}</option>
                                    @endforeach
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <h5 class="mb-2">Ingrédients</h5>

                                <div id="ingredient-row" class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="food">Aliment</label>
                                        <select id="food" name="food[]">
                                            @foreach ($foods as $food)
                                                <option value="{{ $food->id }}">{{ $food->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quantity">Quantité</label>
                                        <input type="number" name="quantity[]" id="quantity"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mesure">Unité de mesure</label>
                                        <select id="mesure" name="mesure[]">
                                            @foreach ($mesures as $mesure)
                                                <option value="{{ $mesure->id }}">{{ $mesure->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <button id="add-ingredient"><i class="fa-sharp fa-solid fa-plus"></i> Ajouter un ingrédient</button>

                        </div>
                    </div>

                </div>
                <!-- End Step 2 -->

                <button id="prev">Précédent</button>
                <button id="next">Suivant</button>
            </form>
        </div>
    </section>
@endsection

@section('javascript')
    <script>

        const stepDiv = document.querySelectorAll('div[data-step]')
        const nextButton = document.querySelector('button#next')
        const prevButton = document.querySelector('button#prev')
        const addButton = document.querySelector('button#add-ingredient')
        const ingredientRow = document.querySelector('#ingredient-row')
        const token = "{{ csrf_token() }}"
        let step = 1;

        const showStep = () => {
            stepDiv.forEach(div => {
                const datastep = div.dataset.step

                if (parseInt(datastep) !== step) {
                    div.style.display = "none"
                } else {
                    div.style.display = "block"
                }

                // Hide previous button or not
                if (step !== 1) {
                    prevButton.style.display = "inline-block"
                } else {
                    prevButton.style.display = "none"
                }
            })
        }
        showStep()

        const nextStep = (e) => {

            e.preventDefault()

            const title = document.querySelector('input[name="title"]').value
            const time = document.querySelector('input[name="time"]').value
            const difficulty = document.querySelector('select[name="difficulty"]').value
            const category = document.querySelector('select[name="category"]').value
            const season = document.querySelector('select[name="season"]').value
            const foods = document.querySelectorAll('select[name="food[]"]')
            const foodsValues = []

            foods.forEach(food => {
                foodsValues.push(food.value)
            })

            const showErrors = (label, data, type, multiple = null) => {

                if (multiple) {
                    const divs = document.querySelectorAll(type + '[name="' + label + '[]"] + div')
                    divs.forEach((value, key) => {

                        if (data.errors[label + '.' + key]) {
                                value.innerText = data.errors[label + '.' + key]
                        } else {
                            value.innerText = ""
                        }
                    })
                } else {
                    const div = document.querySelector(type + '[name="' + label + '"] + div')
                    if (data.errors[label]) {
                        div.innerText = data.errors[label]
                    } else {
                        div.innerText = ""
                    }
                }

            }

            const hideErrors = (label, type, multiple = null) => {

                if (multiple) {
                    const divs = document.querySelectorAll(type + '[name="'+label+'[]"] + div')
                    divs.forEach(value => {
                        value.innerHTML = ""
                    })
                } else {
                    const div = document.querySelector(type + '[name="' + label + '"] + div')
                    div.innerHTML = ""
                }

            }

            if (step == 1) {
                fetch('/recipe/create/step1', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        title,
                        time,
                        difficulty,
                        category,
                    })
                })
                    .then(response => response.json())
                    .then(data => {

                        console.log(data)

                        // If validator fails
                        if (data.errors) {
                            showErrors('time', data, 'input')
                            showErrors('title', data, 'input')
                            showErrors('category', data, 'select')
                            showErrors('difficulty', data, 'select')
                        }


                        if (data == "success") {
                            hideErrors('time', 'input')
                            hideErrors('title', 'input')
                            hideErrors('category', 'select')
                            hideErrors('difficulty', 'select')

                            step++
                            showStep()
                        }

                    })
            }

            if (step == 2) {
                fetch('/recipe/create/step2', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        season,
                        food: foodsValues

                    })
                })
                    .then(response => response.json())
                    .then(data => {

                        console.log(data)

                        // If validator fails
                        if (data.errors) {
                            showErrors('season', data, 'select')
                            showErrors('food', data, 'select', true)

                        }

                        if (data == "success") {
                            hideErrors('season', 'select')
                            hideErrors('food', 'select', true)


                            step++
                            showStep()
                        }

                    })
            }


        }

        const prevStep = (e) => {
            e.preventDefault()
            step--
            showStep()
        }

        const addRowIngredient = (e) => {
            e.preventDefault()
            const row = ingredientRow.cloneNode(true)
            ingredientRow.parentNode.append(row)
        }

        nextButton.addEventListener('click', nextStep)
        prevButton.addEventListener('click', prevStep)
        addButton.addEventListener('click', addRowIngredient)

    </script>
@endsection
