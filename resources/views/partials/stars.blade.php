<span class="stars">
                    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $recipe->averageRatings())
            <i class="fa-solid fa-star"></i>
        @else
            <i class="fa-regular fa-star"></i>
        @endif
    @endfor
</span>
