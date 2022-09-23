<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {

        $recipes = Recipe::with('images')
            ->take(6)
            ->get();

        $lastRecipes = Recipe::with('images')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $topRated = Recipe::whereRelation('comments', 'rating', '>', 4 )
            ->take(3)
            ->get();


        return view('home', [
            'recipes' => $recipes,
            'lastRecipes' => $lastRecipes,
            'topRated' => $topRated
        ]);
    }
}
