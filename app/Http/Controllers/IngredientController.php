<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IngredientController extends Controller
{
    public function index(): View
    {
        $ingredients = Food::query()
            ->where('name', 'LIKE', 'a%')
            ->get();

        $letter = 'a';

        return view('ingredients.index', [
            'ingredients' => $ingredients,
            'letter' => $letter
        ]);
    }

    public function show($letter)
    {
        $ingredients = Food::with('image')
            ->where('name', 'LIKE', $letter . '%')
        ->get();


        return view('ingredients.index', [
            'ingredients' => $ingredients,
            'letter' => $letter
        ]);
    }

    public function showRecipes(Food $ingredient)
    {
//        $recipes = DB::table('recipes')
//            ->join('ingredients', 'recipes.id', '=', 'ingredients.id')
//            ->join('food_ingredient', 'ingredients.id', '=', 'food_ingredient.ingredient_id')
//            ->join('food', 'food_ingredient.food_id','=', 'food.id')
//            ->where('food.name', '=', 'banane')
//            ->get();

//        $recipes = Recipe
//            ::join('ingredients', 'recipes.id', '=', 'ingredients.id')
//            ->join('food_ingredient', 'ingredients.id', '=', 'food_ingredient.ingredient_id')
//            ->join('food', 'food_ingredient.food_id','=', 'food.id')
//            ->select('recipes.*')
//            ->where('food.name', '=', $ingredient->name)
//            ->get();

        $recipes = Recipe::whereHas('ingredients', function(Builder $query) use($ingredient) {
            $query->whereHas('foods', function(Builder $query) use ($ingredient) {
                $query->where('name', '=', $ingredient->name);
            });
        })->get();



        return view('ingredients.showRecipes', [
            'recipes' => $recipes,
            'ingredient' => $ingredient
        ]);
    }
}
