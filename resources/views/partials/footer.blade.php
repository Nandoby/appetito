<footer>
    <div class="container">
        <div>
            <ul>
                <li><h6>Recettes par catégories</h6></li>
                <li><a href="#">Apéritif</a></li>
                <li><a href="#">Entrée</a></li>
                <li><a href="#">Plat</a></li>
                <li><a href="#">Dessert</a></li>
                <li><a href="#">Fromages</a></li>
                <li><a href="#">Fruits</a></li>
            </ul>
            <ul>
                <li><h6>Idées recettes</h6></li>
                <li><a href="{{ route('seasons.index') }}">Recettes de saison</a></li>
                <li><a href="#">Recettes par ingrédients</a></li>
                <li><a href="#">Top des recettes</a></li>
                <li><a href="#">Nouveautés</a></li>
                <li><a href="#">Proposer une recette</a></li>
            </ul>
            <ul>
                <li><h6>Légal</h6></li>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Conditions Générales d'Utilisation</a></li>
                <li><a href="#">Politique de protection des données personnelles</a></li>
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
