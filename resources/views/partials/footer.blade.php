<footer>
    <div class="container">
        <div>
            <ul>
                <li><h6>Recettes par catégories</h6></li>
                <li><a href="{{ route('categories.show', ['category' => 'aperitif']) }}">Apéritif</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'entrée']) }}">Entrée</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'plat']) }}">Plat</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'dessert']) }}">Dessert</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'fromages']) }}">Fromages</a></li>
                <li><a href="{{ route('categories.show', ['category' => 'fruits']) }}">Fruits</a></li>
            </ul>
            <ul>
                <li><h6>Idées recettes</h6></li>
                <li><a href="{{ route('seasons.index') }}">Recettes de saison</a></li>
                <li><a href="{{ route('ingredients.index') }}">Recettes par ingrédients</a></li>
                <li><a href="{{ route('recipe.create') }}">Proposer une recette</a></li>
            </ul>
            <ul>
                <li><h6>Légal</h6></li>
                <li><a href="{{ route('cgu') }}">Conditions Générales d'Utilisation</a></li>
                <li><a href="{{ route('privacy') }}">Confidentialité</a></li>
            </ul>
            <ul>
                <li><h6>Contact</h6></li>
                <li><i class="fa-solid fa-house"></i> Rue du chef 34 - 7021 Havré (BE)</li>
                <li><i class="fa-solid fa-envelope"></i> info@appetito.be</li>
                <li><i class="fa-solid fa-phone"></i> +01 234 567 89</li>
            </ul>
        </div>
        <div class="footer-branding">
            <div>
                <span>Appetito</span>
                <img src="{{ asset('icons/logo.svg') }}" alt="Logo">
            </div>
            <span>Mijoté par Biaccalli Ferdinando</span>
        </div>
    </div>
</footer>
