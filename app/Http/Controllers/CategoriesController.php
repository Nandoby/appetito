<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Show index page of categories
     *
     */
    public function index(Category $category): View
    {
        return view('categories.index', [
            'categories' => $category::all()
        ]);
    }

    public function show(Category $category)
    {

        $cat = Category::query()->where('name', $category->name)->first();

        $recipes = Recipe::query()->whereRelation('category', 'name', $category->name)->get();


        return view('categories.show', [
            'recipes' => $recipes,
            'cat' => $cat
        ]);

    }
}
