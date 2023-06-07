<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $latestEpsidoes = Episode::latest()->take(15)->get();
        $recomendation = User::recomendation();

        return view("index")->with([
            "latest" => $latest,
            "latestTV" => $latestTV,
            "latestFilms" => $latestFilms,
            "latestEpsidoes" => $latestEpsidoes,
            "recomendation" => $recomendation
        ]);
    }
}
