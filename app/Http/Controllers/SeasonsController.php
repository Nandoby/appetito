<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeasonsController extends Controller
{
    /**
     * Show index of the seasons page
     *
     * @return View
     */
    public function index(Season $season): View
    {
        return view('seasons.index', [
            'seasons' => $season::all()
        ]);
    }
}
