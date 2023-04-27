<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Genre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class ShowController extends Controller {

    public function index(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 20;
        $target = $request->input("target");

        $query = Show::latest()->select("id", "poster", "title", "runTime", "type", "rating", "keywords", "releaseDate", "created_at");

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
            "shows" => $shows->map(function($show) {
                return $show->populate();
            }),
            "search" => $search,
            "page" => $page,
            "max" => $max,
            "target" => $target
        ]);
    }

    public function add(Request $request) {
        $genres = Genre::list();

        return view("admin/shows/add")->with("genres", $genres);
    }

    public function edit($showID) {
        $show = Show::find($showID);
        $genres = Genre::list();

        return view("admin/shows/add", [
            "show" => $show->populate(),
            "genres" => $genres
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "type" => "required",
            "rating" => "required",
            "runTime" => "required",
            "releaseDate" => "required|date",
            "keywords" => "required",
            "genres" => "required",
            "poster" => "required|image|mimes:jpg,png,jpeg,gif,svg,webp",
            "thumbnail" => "image|mimes:jpg,png,jpeg,gif,svg,webp"
        ]);

        $posterName = time().".".$request->poster->getClientOriginalExtension();
        $request->poster->move(public_path("posters"), $posterName);

        if($request->thumbnail) {
            $thumbName = time().".".$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path("thumbnails"), $thumbName);
        }

        $show = new Show(array_merge($request->except(["poster", "genres", "thumbnail"]), [
            "poster" => $posterName,
            "thumbnail" => $thumbName
        ]));

        $show->save();

        $show->editGenres($request->genres);

        return redirect("admin/shows") -> with("status", "Show has been created successfuly");
    }

    public function delete($showID) {
        $show = Show::find($showID);

        $show->genres()->delete();
        $show->favorites()->delete();

        File::delete(public_path("posters") . "/" . $show -> poster);
        if($show -> thumbnail)
        File::delete(public_path("thumbnails") . "/" . $show -> thumbnail);

        $show->delete();

        return redirect("/admin/shows") -> with("status", "Client has been deleted successfuly");
    }

    public function update($showID, Request $request) {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "type" => "required",
            "rating" => "required",
            "runTime" => "required",
            "releaseDate" => "required|date",
            "keywords" => "required",
            "genres" => "required",
            "poster" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
            "thumbnail" => "image|mimes:jpg,png,jpeg,gif,svg,webp"
        ]);

        $show = Show::find($showID);

        if($request->poster) {
            $posterName = time().".".$request->poster->getClientOriginalExtension();
            $request->poster->move(public_path("posters"), $posterName);
            File::delete(public_path("posters") . "/" . $show -> poster);
        }

        if($request->thumbnail) {
            $thumbName = time().".".$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path("thumbnails"), $thumbName);
            if($show -> thumbnail)
            File::delete(public_path("thumbnails") . "/" . $show -> thumbnail);
        }

        $show->editGenres($request->genres);
        $images = [];

        if($request -> poster) $images["poster"] = $posterName;
        if($request -> thumbnail) $images["thumbnail"] = $thumbName;

        $show->update(array_merge($images, $request -> except(["poster", "genres", "thumbnail"])));

        return redirect("/admin/shows")->with("status", "Show have been updated successfuly");
    }

    public function show($showID) {
        $show = Show::find($showID);
        $user = Auth::user();

        return view("shows/single")->with([
            "show" => $show->populate(),
            "user" => $user
        ]);
    }
}
