<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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
}
