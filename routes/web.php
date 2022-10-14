<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/recipe/create', [RecipeController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('recipe.create');

/* Ajax validation */
Route::post('/recipe/create/step1', [RecipeController::class, 'validateAjax1'])->name('recipe.validateAjax1');
Route::post('/recipe/create/step2', [RecipeController::class, 'validateAjax2'])->name('recipe.validateAjax2');
Route::post('/recipe/create/step3', [RecipeController::class, 'validateAjax3'])->name('recipe.validateAjax3');
Route::post('/recipe/create/step4', [RecipeController::class, 'validateAjax4'])->name('recipe.validateAjax4');
Route::post('/recipe/store', [RecipeController::class, 'store'])->name('recipe.store');

/* Search  */
Route::get('/search', [SearchController::class, 'search'])->name('recipes.search');

/* Authentication */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'create'])->name('register.create');

/* Comments */
Route::post('/comments/create', [CommentController::class, 'create'])->name('comments.create');

/* Verification by Email */
Route::get('/email/verify', function () {
    return view('authentication.verify-email');
})->middleware('auth')->name('verification.notice');

/* Confirmation */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home')->with('emailVerified', 'votre compte a bien été activé');
})->middleware(['auth', 'signed'])->name('verification.verify');

/** Resend email verification */
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Demande de verification envoyée');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/** Profile */
Route::get('/profile', [UserController::class, 'profile'])
    ->middleware(['auth', 'verified'])
    ->name('profile')
;
