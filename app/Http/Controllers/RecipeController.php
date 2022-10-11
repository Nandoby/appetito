<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecipeController extends Controller
{
    public function index($slug)
    {

        $recipe = Recipe::with(['images.imageable', 'comments.user', 'ingredients.foods.image', 'ingredients.mesure'])
        ->where('slug', '=', $slug)->firstOrFail();

        // Pagination avec un link sur l'id "comments"
        $comments = $recipe->comments()->paginate(5)->fragment('comments');

        if (Auth::user()) {
            Session::put('user', Auth::user());
            Session::put('recipe', $recipe);
        }

        return view('recipe.index', compact('recipe', 'comments'));
    }
}
