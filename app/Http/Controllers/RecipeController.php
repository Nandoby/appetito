<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Food;
use App\Models\Image;
use App\Models\Ingredient;
use App\Models\Mesure;
use App\Models\Recipe;
use App\Models\Season;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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
            'title' => ['required', 'unique:recipes,title'],
            'time' => ['required'],
            'category' => ['required', 'in:1,2,3,4,5,6'],
            'difficulty' => ['required', 'in:1,2,3'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
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
            'quantity.*' => ['required', 'numeric'],
            'mesure.*' => ['required', 'in:1,2,3,4,5,6']

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json('success', 200);
    }

    public function validateAjax3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'step.*' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json('success');
    }

    public function validateAjax4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => ['mimes:jpg,png,bmp', File::image()->max(2000)]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json('success');
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $title = $request->input('title');
        $time = $request->input('time');
        $categoryID = $request->input('category');
        $difficultyID = $request->input('difficulty');
        $seasonID = $request->input('season');
        $foodsID = $request->input('food');
        $quantities = $request->input('quantity');
        $mesuresID = $request->input('mesure');
        $steps = $request->input('step');
        $images = $request->file('image');
        $ingredientsArray = [];
        $ingredients = [];


        // Convertir les heures et minutes en secondes
        $timeSplit = explode(':', $time);
        $hours = $timeSplit[0];
        $minutes = $timeSplit[1];
        $secondes = $hours * 3600 + $minutes * 60;



        foreach($foodsID as $key => $value) {
            $ingredientsArray[] = [
                'food' => $foodsID[$key],
                'quantity' => $quantities[$key],
                'mesure' => $mesuresID[$key]
            ];
        }

        $recipe = new Recipe();
        $recipe->title = $title;
        $recipe->slug = Str::slug($title, '-');
        $recipe->time = $secondes;
        $recipe->category()->associate($categoryID);
        $recipe->difficulty()->associate($difficultyID);
        $recipe->season()->associate($seasonID);
        $recipe->user()->associate($user);
        $recipe->save();
//        $recipe->ingredients()->saveMany()

        foreach($ingredientsArray as $ingred) {

            $food = Food::find($ingred['food']);
            $mesure = Mesure::find($ingred['mesure']);

            $ingredient = new Ingredient();
            $ingredient->quantity = $ingred['quantity'];
            $ingredient->recipe()->associate($recipe);
            $ingredient->mesure()->associate($mesure);
            $ingredient->save();
            $ingredient->foods()->save($food);
        }

        foreach ($steps as $s) {
            $step = new Step();
            $step->content = $s;
            $recipe->steps()->save($step);
        }

        if ($request->file('image')) {
            foreach ($request->file('image') as $file) {

                $path = Storage::disk('public')->put('images', $file);
                $filename = str_replace('images/', '', $path);

                $image = new Image();
                $image->path = $filename;
                $image->imageable_id = $recipe->id;
                $image->imageable_type = Recipe::class;
                $image->save();
            }

            return redirect()->route('home');

        } else {
            $image = new Image();
            $image->path = "default-upload-image.jpg";
            $image->imageable_id = $recipe->id;
            $image->imageable_type = Recipe::class;
            $image->save();

            return redirect()->route('home');
        }

    }

    public function delete(Request $request)
    {

        $recipe = Recipe::find($request->input('recipe'));

        if (Auth::user() == $recipe->user) {

            $recipe->ingredients()->delete();
            $recipe->steps()->delete();
            $recipe->comments()->delete();
            $recipe->delete();


            return response()->json([
                'recipe' => $recipe
            ]);
        } else {
            return response()->json('owner');
        }
    }

    public function edit($id)
    {


        $recipe = Recipe::find($id);
        $categories = Category::all();
        $difficulties = Difficulty::all();
        $seasons = Season::all();
        $foods = Food::all();
        $mesures = Mesure::all();

        Session::put('recipe', $recipe);

        if (Auth::user() != $recipe->user) {
            return back();
        }

        return view('recipe.edit', [
            'recipe' => $recipe,
            'categories' => $categories,
            'difficulties' => $difficulties,
            'seasons' => $seasons,
            'foods' => $foods,
            'mesures' => $mesures,
        ]);
    }

    public function editStore(Request $request)
    {

        $mesures = Mesure::all();
        $foods = Food::all();
        $categories = Category::all();
        $seasons = Season::all();
        $difficulties = Difficulty::all();

        $mesuresID = [];
        $foodsID = [];
        $categoriesID = [];
        $seasonsID = [];
        $difficultiesID = [];

        foreach($mesures as $mesure) {
            $mesuresID[] = $mesure->id;
        }

        foreach($foods as $food) {
            $foodsID[] = $food->id;
        }

        foreach($categories as $category) {
            $categoriesID[] = $category->id;
        }

        foreach($seasons as $season) {
            $seasonsID[] = $season->id;
        }

        foreach($difficulties as $difficulty) {
            $difficultiesID[] = $difficulty->id;
        }

        $rules = [
            'steps.*' => 'required',
            'title' => 'required',
            'category' => ['required', Rule::in($categoriesID)],
            'quantity.*' => 'required',
            'season' => ['required', Rule::in($seasonsID[])],
            'foods.*' => ['required', Rule::in($foodsID)],
            'mesure.*' => ['required', Rule::in($mesuresID)],
            'time' => 'required',
            'difficulty' => ['required', Rule::in($difficultiesID)]
        ];

        $validated = $request->validate($rules);

        $user = Auth::user();
        $title = $request->input('title');
        $time = $request->input('time');
        $categoryId = $request->input('category');
        $difficultyId = $request->input('difficulty');
        $seasonId = $request->input('season');
        $foodsArray = $request->input('foods');
        $quantityArray = $request->input('quantity');
        $mesureArray = $request->input('mesure');
        $steps = $request->input('steps');
        $ingredientsArray = [];

        // Convertir le temps en secondes
        $timeSplit = explode(':', $time);
        $hours = $timeSplit[0];
        $minutes = $timeSplit[1];
        $secondes = $hours * 3600 + $minutes * 60;

        foreach($foodsArray as $key => $value) {
            $ingredientsArray[] = [
                'food' => $foodsArray[$key],
                'quantity' => $quantityArray[$key],
                'mesure' => $mesureArray[$key]
            ];
        }

        $recipe = Session::get('recipe');
        $recipe->title = $title;
        $recipe->slug = Str::slug($title,'-');
        $recipe->time = $secondes;
        $recipe->ingredients()->delete();
        $recipe->steps()->delete();
        $recipe->category()->associate($categoryId);
        $recipe->difficulty()->associate($difficultyId);
        $recipe->season()->associate($seasonId);
        $recipe->user()->associate($user);
        $recipe->save();

        foreach($ingredientsArray as $ingred) {

            $food = Food::find($ingred['food']);
            $mesure = Mesure::find($ingred['mesure']);

            $ingredient = new Ingredient();
            $ingredient->quantity = $ingred['quantity'];
            $ingredient->recipe()->associate($recipe);
            $ingredient->mesure()->associate($mesure);
            $ingredient->save();
            $ingredient->foods()->save($food);
        }

        foreach ($steps as $s) {
            $step = new Step();
            $step->content = $s;
            $recipe->steps()->save($step);
        }

        return redirect()->back()->with('success', 'Votre modification a bien été enregistrée');


    }
}
