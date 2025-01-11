<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class LandingController extends Controller
{
    public function index() {

        $informations = Information::where('status', 'Publish')->with(['event.banners', 'event.competitions', 'event.documents'])->get();

        return view('landing.index', [
            'informations' => $informations
        ]);
    }
}
