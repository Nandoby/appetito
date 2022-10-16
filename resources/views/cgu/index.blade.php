@extends('layout.app')

@section('title')
    Conditions générales
@endsection

@section('stylesheet')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-4xl text-gray-900 font-semibold">Conditions générales</h1>
        <h4 class="text-lg text-gray-800 font-semibold">Nom du site</h4>
        <span class="text-left font-light">Appetito</span>

        <h4 class="text-lg text-gray-800 font-semibold mt-3">Editeur</h4>
        <span class="text-left font-light block">Biaccalli Ferdinando</span>
        <span class="text-left font-light block">Rue Allende 38</span>
        <span class="text-left font-light block">7021 Havré</span>
        <span class="text-left font-light block mb-4">BELGIQUE</span>

        <h4 class="text-lg text-gray-800 font-semibold my-2">Comment utiliser les recettes diffusées sur ce site</h4>

        <div class="font-light mb-2">
            Toutes les recettes diffusées sur le site peuvent être utilisées dans le cadre des trois hypothèses décrites
            ci-dessous selon votre statut.
        </div>
        <div class="font-light mb-2">
            Dans tous les cas, vous ne pouvez pas les reproduire pour en faire un usage commercial.
        </div>
        <div class="font-light mb-2">
            Les recettes diffusées sur le site sont incorporées dans une base de données appartenant à la société
            Appetito, vous ne pouvez
            ni reproduire cette base de données, ni extraire des données contenues dans cette base autrement que pour
            votre usage privé.
        </div>

        <h4 class="text-lg text-gray-800 font-semibold my-2">Vous avez des recettes, faites-les partager</h4>

        <div class="font-light mb-2">
            Allez dans la rubrique &laquo; Proposer une recette &raquo; et remplissez le formulaire.
        </div>

        <div class="font-light mb-2">
            En remplissant le formulaire vous garantissez que à votre connaissance, cette recette ne vient pas d'un
            ouvrage ou d'un recueil de recettes ; vous autorisez APPETITO à diffuser cette recette sur son site et à
            l'intégrer dans sa base de données gratuitement.
        </div>

        <h4 class="text-lg text-gray-800 font-semibold my-2">Responsabilité</h4>

        <div class="font-light mb-2">
            Appetito ne garantit pas le résultat des recettes diffusées sur son site, ni leur qualité. Appetito ne
            garantit pas que les recettes répondront aux attentes des internautes ou que leurs résultats seront exacts
            et fiables.
        </div>

        <div class="font-light mb-2">
            En conséquence, la responsabilité de Appetito ne saurait être engagée en cas d'erreur ou d'omission dans
            l'une de ces recettes, textes, informations ou illustrations diffusées sur son site.
        </div>


    </div>
@endsection
