<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Recipe;
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
        $foods = $ingredient::with('ingredients')->get();


        foreach ( $foods as $food) {
            $ingredients = $food->ingredients;

            foreach ($ingredients as $ingredient) {
                dump($ingredient->recipes);
            }

        }



//        return view('ingredients.showRecipes');
    }
}
