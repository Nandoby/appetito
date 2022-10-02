<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $recipes = Recipe::with(['ingredients','images', 'comments'])
            ->whereHas('ingredients', function(Builder $query) use($request) {
            $query->whereHas('foods', function(Builder $query) use($request) {
                $query->where('name', 'like', '%'.$request->input('recipe').'%');
            });
        })
            ->orWhere('title', 'like', '%'.$request->input('recipe').'%')
            ->orderBy('title', 'ASC')
            ->get();

        return view('recipe.search', [
            'recipes' => $recipes,
            'request' => $request
        ]);

    }
}
