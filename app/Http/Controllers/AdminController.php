<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Food;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home');
        }

        $user = auth()->user();
        $users = User::all();
        $recipes = Recipe::all();
        $comments = Comment::all();
        $foods = Food::all();


        return view('admin.index', [
            'user' => $user,
            'users' => $users,
            'recipes' => $recipes,
            'comments' => $comments,
            'foods' => $foods,
        ]);

    }

    public function users()
    {
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function usersEdit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function usersUpdate(Request $request)
    {

        $rules = [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required'
        ];

        $validation = $request->validate($rules);

        $user = User::where('email', $request->input('email'))->firstOrFail();

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->save();

        return back()->with('success', 'Utilisateur modifié avec succès');
    }

    public function usersDestroy($user)
    {
        $User = User::find($user);

        $User->comments()->delete();

        foreach ($User->recipes as $recipe) {
            $recipe->comments()->delete();
            $recipe->ingredients()->delete();
            $recipe->steps()->delete();
        }

        $User->recipes()->delete();

        $User->delete();

        return back()->with('success', "L'utilisateur a été supprimé avec success");
    }

    public function recipes()
    {
        $recipes = Recipe::with('category', 'difficulty', 'season')->paginate(10);

        return view('admin.recipes.index', compact('recipes'));
    }

    public function recipeDestroy($recipe)
    {
        $_recipe = Recipe::find($recipe);

        $_recipe->comments()->delete();
        $_recipe->ingredients()->delete();
        $_recipe->steps()->delete();
        $_recipe->delete();

        return back()->with('success', "La recette a bien été supprimée");
    }

    public function ingredients()
    {
        $foods = Food::paginate(10);

        return view('admin.ingredients.index', compact('foods'));
    }

    public function ingredientEdit(Food $food)
    {
       return view('admin.ingredients.edit', compact('food'));
    }

    public function ingredientUpdate(Request $request, $food)
    {
        $_food = Food::find($food);

        $rules = [
            'name' => 'required|unique:food,name|alpha'
        ];

        $validation = $request->validate($rules);

        $_food->name = $request->input('name');
        $_food->save();

        return back()->with('success', "L'ingrédient a été modifié avec succès");
    }

    public function ingredientDestroy($food)
    {
        $_food = Food::find($food);

        $_food->delete();

        return back()->with('success', "L'ingrédient a été supprimé avec succès");

    }
}
