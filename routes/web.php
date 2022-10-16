<?php

use App\Http\Controllers\AdminController;
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

Route::controller(RecipeController::class)->group(function () {
    /* Recipes */
    Route::get('/recipes/{slug}', 'index')->name('recipes.index');
    Route::get('/recipe/create', 'create')->middleware(['auth', 'verified'])->name('recipe.create');

    /* Ajax validation */
    Route::post('/recipe/create/step1', 'validateAjax1')->name('recipe.validateAjax1');
    Route::post('/recipe/create/step2', 'validateAjax2')->name('recipe.validateAjax2');
    Route::post('/recipe/create/step3', 'validateAjax3')->name('recipe.validateAjax3');
    Route::post('/recipe/create/step4', 'validateAjax4')->name('recipe.validateAjax4');
    Route::post('/recipe/store', 'store')->name('recipe.store');
    Route::post('/recipe/delete', 'delete')->name('recipe.delete');
    Route::get('/recipe/edit/{id}', 'edit')->name('recipe.edit')->middleware(['auth', 'verified']);
    Route::post('/recipe/edit/store', 'editStore')->name('recipe.editStore');
});


/* Search  */
Route::get('/search', [SearchController::class, 'search'])->name('recipes.search');

/* Authentication */
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'create')->name('register.create');
});


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

/** Administration */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');

    Route::get('/admin/recipes', [AdminController::class, 'recipes'])->name('admin.recipes.index');
    Route::delete('/admin/recipes/{recipe}', [AdminController::class, 'recipeDestroy'])->name('admin.recipes.destroy');

    Route::get('/admin/ingredients', [AdminController::class, 'ingredients'])->name('admin.ingredients.index');
    Route::get('/admin/ingredients/{food}/edit', [AdminController::class, 'ingredientEdit'])->name('admin.ingredients.edit');
    Route::put('/admin/ingredients/{food}', [AdminController::class, 'ingredientUpdate'])->name('admin.ingredients.update');
    Route::delete('/admin/ingredients/{food}', [AdminController::class, 'ingredientDestroy'])->name('admin.ingredients.destroy');

});
