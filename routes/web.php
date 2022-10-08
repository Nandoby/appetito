<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeasonsController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//$categories = Category::all();
//$cat = [];
//
//foreach ($categories as $category) {
//    $cat[] = $category->name;
//}

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/* Catégories */
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');

/* Saisons */
Route::get('/saisons', [SeasonsController::class, 'index'])->name('seasons.index');
Route::get('/saisons/{saison:name}', [SeasonsController::class, 'show'])->name('seasons.show');

/* Ingrédients */
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::get('/ingredients/{letter}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::get('/ingredients/{ingredient:name}/recipes', [IngredientController::class, 'showRecipes'])->name('ingredients.recipes');

/* Recipes */
Route::get('/recipes/{slug}', [RecipeController::class, 'index'])->name('recipes.index');

/** Search  */
Route::get('/search', [SearchController::class, 'search'])->name('recipes.search');
