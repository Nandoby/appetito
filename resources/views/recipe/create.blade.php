@extends('layout.app')

@section('title')
    Création recette
@endsection

@section('content')
    <section id="recipe-create">
        <div class="container">
            <h1>Ajouter une recette</h1>

            <form id="myForm" action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mesure">Unité de mesure</label>
                                        <select id="mesure" name="mesure[]">
                                            @foreach ($mesures as $mesure)
                                                <option value="{{ $mesure->id }}">{{ $mesure->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="mb-3" id="add-ingredient"><i class="fa-sharp fa-solid fa-plus"></i> Ajouter un ingrédient</button>

                        </div>
                    </div>

                </div>
                <!-- End Step 2 -->

                <!-- Step 3 -->
                <div data-step="3">
                    <h5 class="mb-3">Etapes</h5>
                    <div id="step-row">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="step">Etape <span id="step-number">1</span></label>
                                <textarea id="step" name="step[]"></textarea>
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <button id="add-step" class="mb-3">Ajouter étape</button>
                </div>
                <!-- End Step 3 -->

                <!-- Step 4 -->
                <div data-step="4">
                    <h5 class="mb-3">Images</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="js-label" for="image">
                                <img src="{{ asset('storage/images/default-upload-image.jpg') }}" height="400" alt="image" />
                            </label>
                            <input type="file" id="image" name="image[]" />
                            <div class="error mb-3"></div>
                        </div>
                        <div id="add-more" class="col-md-4">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>

                </div>
                <!-- End Step 4 -->

                <button class="mb-3" id="prev">Précédent</button>
                <button class="mb-3" id="next">Suivant</button>
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
        const addStepButton = document.querySelector('button#add-step')
        const ingredientRow = document.querySelector('#ingredient-row')
        const stepRow = document.querySelector('#step-row')
        const token = "{{ csrf_token() }}"
        const addImageButton = document.querySelector('#add-more')
        const myForm = document.querySelector('#myForm')
        let step = 1;

        const showImage = () => {
            const inputFile = document.querySelectorAll('input[name="image[]"]')

            inputFile.forEach((input, key) => {
                const label = input.previousElementSibling
                label.setAttribute('for', `image-${key}`)
                const image = label.querySelector('img')
                input.id = `image-${key}`


                input.addEventListener('change', (e) => {

                    const url = window.URL.createObjectURL(e.currentTarget.files[0])
                    image.src = url

                })
            })
        }
        showImage()

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

            console.log(step)

            e.preventDefault()

            const title = document.querySelector('input[name="title"]').value
            const time = document.querySelector('input[name="time"]').value
            const difficulty = document.querySelector('select[name="difficulty"]').value
            const category = document.querySelector('select[name="category"]').value
            const season = document.querySelector('select[name="season"]').value
            const foods = document.querySelectorAll('select[name="food[]"]')
            const quantities = document.querySelectorAll('input[name="quantity[]"]')
            const mesures = document.querySelectorAll('select[name="mesure[]"]')
            const steps = document.querySelectorAll('textarea[name="step[]"]')
            const images = document.querySelectorAll('input[name="image[]"]')
            const foodsValues = []
            const quantitiesValues = []
            const mesuresValues = []
            const stepsValues = []
            const imagesPaths = []

            // Functions
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
            const hideErrors = (label, type, multiple = null) =>     {

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
            const postData = async (url, data = {}, contentType = 'application/json') => {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': contentType,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(data)
                })

                return response.json()
            }
            // End Functions

            foods.forEach(food => {
                foodsValues.push(food.value)
            })
            quantities.forEach(quant => {
                quantitiesValues.push(quant.value)
            })
            mesures.forEach(mesure => {
                mesuresValues.push(mesure.value)
            })
            steps.forEach(step => {
                stepsValues.push(step.value)
            })



            if (step == 1) {
                postData('/recipe/create/step1', {title,time,difficulty,category})
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
                postData('/recipe/create/step2', {
                    season,
                    food: foodsValues,
                    quantity: quantitiesValues,
                    mesure: mesuresValues
                })
                    .then(data => {

                        // If validator fails
                        if (data.errors) {
                            showErrors('season', data, 'select')
                            showErrors('food', data, 'select', true)
                            showErrors('quantity', data, 'input', true)
                            showErrors('mesure', data, 'select', true)
                        }

                        if (data == "success") {
                            hideErrors('season', 'select')
                            hideErrors('food', 'select', true)
                            hideErrors('quantity', 'input', true)
                            hideErrors('mesure', 'select', true)

                            step++
                            showStep()
                        }

                    })
            }

            if (step == 3) {
                postData('/recipe/create/step3', {
                    step: stepsValues
                })
                    .then(data => {

                        // If validator fails
                        if (data.errors) {
                            showErrors('step', data, 'textarea', true)
                        }

                        if (data == "success") {
                            hideErrors('step', 'textarea', true)

                            step++
                            showStep()
                        }
                    })
            }

            if (step == 4) {

                const data = new FormData()

                images.forEach(image => {
                    data.append('image[]', image.files[0])
                })

                fetch('/recipe/create/step4', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: data
                })
                    .then(response => response.json())
                    .then(data => {

                        // If validation fails
                        if (data.errors) {
                            showErrors('image', data, 'input', true)
                        }

                        if (data == "success") {
                            hideErrors('image', 'input', true)
                            myForm.submit()


                        }
                    })
                showStep()
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

        const addRowStep = (e) => {
            e.preventDefault()
            const row = stepRow.cloneNode(true)
            row.querySelector('textarea').value = ""
            addStepButton.insertAdjacentElement('beforebegin', row)

            const rows = document.querySelectorAll('#step-row')

            rows.forEach((value, key) => {
                value.querySelector('#step-number').innerHTML = key + 1
            })



        }

        const addImage = (e) => {
            const $this = e.currentTarget
            const image = $this.previousElementSibling
            const newImage = image.cloneNode(true)
            newImage.querySelector('img').src = "{{ asset('/storage/images/default-upload-image.jpg') }}"

            $this.insertAdjacentElement('beforebegin', newImage)

            showImage()


        }

        nextButton.addEventListener('click', nextStep)
        prevButton.addEventListener('click', prevStep)
        addButton.addEventListener('click', addRowIngredient)
        addStepButton.addEventListener('click', addRowStep)
        addImageButton.addEventListener('click', addImage)

    </script>
@endsection
