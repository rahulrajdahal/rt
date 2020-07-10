<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class BioController extends Controller
{
    public function index(Team $member) {
        $team = Team::all();
        return view('bio.index', ['member' => $member, 'team' => $team]);
    }
}
