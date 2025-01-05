<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class LandingController extends Controller
{
    public function index() {

        $informations = Information::with(['event.banners', 'event.competitions'])->get();

        // dd($informations);

        return view('landing.index', [
            'informations' => $informations
        ]);
    }
}
