<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {

        $recipes = Recipe::with('images')
            ->take(6)
            ->get();

        $lastRecipes = Recipe::with('images', 'category', 'difficulty')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $topRated = Recipe::with(['comments' => function ($query) {
            $query->orderBy('rating', 'desc');
        }, 'category', 'difficulty', 'images'])
            ->take(3)
            ->get();

        return view('home', [
            'recipes' => $recipes,
            'lastRecipes' => $lastRecipes,
            'topRated' => $topRated
        ]);
    }
}
