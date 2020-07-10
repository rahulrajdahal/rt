<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class LandingPageController extends Controller
{
    public function index()
    {
        $featuredProjectOne = Project::where([['hidden', false], ['news', false]])->orderBy('project_date', 'desc')->first();
        $featuredProjectTwo = Project::where([['hidden', false], ['news', false]])->orderBy('project_date', 'desc')->skip(1)->take(1)->first();
        $featuredProjectThree = Project::where([['hidden', false], ['news', false]])->orderBy('project_date', 'desc')->skip(2)->take(1)->first();
        $projects = Project::where([['hidden', '=', false], ['news', '=', false]])->orderBy('project_date', 'desc')->take(4)->get();
        $latestEvent = Project::orderBy('project_date', 'desc')
            ->where([
                ['event', '=', true],
                ['hidden', '=', false]
            ])
            ->first();
        $news = Project::orderBy('project_date', 'desc')
            ->where([
                ['news', '=', true],
                ['hidden', '=', false]
            ])
            ->take(3)->get();
        return view('index')
            ->with('featuredProjectOne', $featuredProjectOne)
            ->with('featuredProjectTwo', $featuredProjectTwo)
            ->with('featuredProjectThree', $featuredProjectThree)
            ->with('projects', $projects)
            ->with('latestEvent', $latestEvent)
            ->with('news', $news);
    }
}
