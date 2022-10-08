<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index($slug)
    {

        $recipe = Recipe::with('images', 'comments.user', 'ingredients.foods', 'ingredients.mesure')
        ->where('slug', '=', $slug)->firstOrFail();

        return view('recipe.index', compact('recipe'));
    }
}
