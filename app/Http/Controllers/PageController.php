<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;

class PageController extends Controller
{
    public function HomePage() {
        $latest = Show::latest()->take(3)->get()->map(function($show) {
            return $show->populate();
        });
        $latestTV = Show::where("type", "TV SHOW")->latest()->take(3)->get()->map(function($show) {
            return $show->populate();
        });

        return view("index")->with([
            "latest" => $latest,
            "latestTV" => $latestTV 
        ]);
    }
}
