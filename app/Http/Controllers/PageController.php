<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Show;

class PageController extends Controller
{
    public function HomePage() {
        $latest = Show::latest()->take(3)->get()->map(function($show) {
            return $show->populate();
        });
        $latestTV = Show::where("type", "TV SHOW")->latest()->take(10)->get()->map(function($show) {
            return $show->populate();
        });
        $latestFilms = Show::where("type", "Film")->latest()->take(10)->get()->map(function($show) {
            return $show->populate();
        });
        $latestEpsidoes = Episode::latest()->take(20)->get();

        return view("index")->with([
            "latest" => $latest,
            "latestTV" => $latestTV,
            "latestFilms" => $latestFilms,
            "latestEpsidoes" => $latestEpsidoes
        ]);
    }
}
