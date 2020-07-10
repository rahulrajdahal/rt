<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class AboutUsController extends Controller
{
    public function index() {
        $team = Team::all();
        return view('about.index', ['team' => $team]);
    }
}
