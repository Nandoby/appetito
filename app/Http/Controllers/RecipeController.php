<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Food;
use App\Models\Mesure;
use App\Models\Recipe;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    /** Création de la recette */
    public function create()
    {
        $categories = Category::all();
        $difficulties = Difficulty::all();
        $seasons = Season::all();
        $foods = Food::all();
        $mesures = Mesure::all();

        return view('recipe.create', compact(
            'categories',
            'difficulties',
            'seasons',
            'foods',
            'mesures'
        ));
    }

    public function validateAjax1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'time' => ['required'],
            'category' => ['required', 'in:1,2,3,4,5,6'],
            'difficulty' => ['required', 'in:1,2,3'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        return response()->json('success', 200);
    }

    public function validateAjax2(Request $request)
    {

        $foods = Food::all();
        $idFoods = [];

        foreach($foods as $food) {
            $idFoods[] = $food->id;
        }

        $validator = Validator::make($request->all(), [
           'season' => ['required','in:1,2,3,4'],
            'food.*' => ['required', Rule::in($idFoods)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        return response()->json('success', 200);
    }
}
