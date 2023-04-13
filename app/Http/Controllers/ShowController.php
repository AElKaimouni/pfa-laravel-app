<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;

class ShowController extends Controller {

    public function index(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 20;
        $target = $request->input("target");

        $query = Show::select("id", "poster", "title", "runTime", "type", "rating", "keywords", "releaseDate", "created_at");

        if($target) $query = $query->where("type", $target);
        if($search) $query = $query->where("title", "like", "%" . $request->input("search") . "%");

        $count = $query->count();
        $tvCount = (clone $query)->where("type", "TV SHOW")->count();
        $filmCount = (clone $query)->where("type", "Film")->count();

        $shows =  $query->skip($page * $max)->take($max)->get();
        
        return view("admin/shows/index")->with([
            "count" => $count,
            "tvCount" => $tvCount,
            "filmCount" => $filmCount,
            "shows" => $shows,
            "search" => $search,
            "page" => $page,
            "max" => $max,
            "target" => $target
        ]);
    }

    public function add(Request $request) {
        return view("admin/shows/add");
    }

    public function create(Request $request) {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "type" => "required",
            "rating" => "required",
            "runTime" => "required",
            "releaseDate" => "required|date",
            "poster" => "image|mimes:jpg,png,jpeg,gif,svg"
        ]);

        $posterName = time().".".$request->poster->getClientOriginalExtension();
        $request->poster->move(public_path("posters"), $posterName);

        $show = new Show(array_merge($request->except(["poster"]), [
            "poster" => $posterName
        ]));

        $show->save();

        return redirect("admin/shows") -> with("status", "Show has been created successfuly");
    }

    public function delete($showID) {
        Show::destroy($showID);

        return redirect("/admin/shows") -> with("status", "Client has been deleted successfuly");
    }
}
