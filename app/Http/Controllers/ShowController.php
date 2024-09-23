<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Genre;
use App\Models\Related;
use App\Models\Celebrity;
use App\Models\Review;
use App\Models\Episode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


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
        $shows = Show::select("title", "id")->get();
        $genres = Genre::list();
        $celebrities = Celebrity::all();

        return view("admin/shows/add")->with([
            "genres" => $genres,
            "shows" => $shows,
            "celebrities" => $celebrities
        ]);
    }

    public function edit($showID) {
        $show = Show::find($showID);
        $shows = Show::select("title", "id")->where("id", "!=", $show["id"])->get();
        $genres = Genre::list();
        $celebrities = Celebrity::all();
        $showCelebrities = $show->celebrities()->get();
        $relateds = $show->relatedsList()->toArray();

        return view("admin/shows/add", [
            "show" => $show->populate(),
            "genres" => $genres,
            "shows" => $shows,
            "celebrities" => $celebrities,
            "showCelebrities" => $showCelebrities,
            "relateds" => $relateds
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

            "poster" => "required|image|mimes:jpg,png,jpeg,gif,svg,webp",
            "thumbnail" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
            "celebrities" => "array"
        ]);

        

        $posterName = time().".".$request->poster->getClientOriginalExtension();
        $request->poster->move(public_path("posters"), $posterName);

        if($request->thumbnail) {
            $thumbName = time().".".$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path("thumbnails"), $thumbName);
        }

        $show = new Show(array_merge($request->except(["poster", "genres", "thumbnail", "relatedShows", "celebrities"]), [
            "poster" => $posterName,
            "thumbnail" => isset($thumbName) ? $thumbName : ""
        ]));

        $show->save();

        $show->editGenres($request->genres);
        $show->editRelateds($request->relatedShows);

        if($request->celebrities) $show->editCelebrities($request->celebrities);

        return redirect("admin/shows") -> with("status", "Show has been created successfuly");
    }

    public function delete($showID) {
        $show = Show::find($showID);

        $epCount = $show->episodes()->count();

        if($epCount > 0) return redirect("/admin/shows") -> 
        withErrors(["staus" => "Please remove this show episodes before trying to remove it."]);

        $show->genres()->delete();
        $show->favorites()->delete();
        $show->reviews()->delete();
        $show->celebrities()->delete();
        $show->relateds()->delete();

        File::delete(public_path("posters") . "/" . $show -> poster);
        if($show -> thumbnail)
        File::delete(public_path("thumbnails") . "/" . $show -> thumbnail);

        $show->delete();

        return redirect("/admin/shows") -> with("status", "Show has been deleted successfuly");
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
            "poster" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
            "thumbnail" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
            "celebrities" => "array"
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
        $show->editRelateds($request->relatedShows);
        $images = [];

        if($request -> poster) $images["poster"] = $posterName;
        if($request -> thumbnail) $images["thumbnail"] = $thumbName;

        if($request->celebrities) $show->editCelebrities($request->celebrities);
        else $show -> celebrities() -> delete();

        $show->update(array_merge($images, $request -> except(["poster", "genres", "thumbnail", "relatedShows", "celebrities"])));

        return redirect("/admin/shows")->with("status", "Show have been updated successfuly");
    }

    public function show($showID, Request $request) {
        $e_page = $request->input("epage");
        $e_max = $request->input("emax") ?: 25;
        $r_page = $request->input("rpage");
        $r_max = $request->input("rmax") ?: 10;
        $re_page = $request->input("repage");
        $re_max = $request->input("remax") ?: 10;

        $show = Show::find($showID);
        $user = Auth::user();

        $episodes = Episode::show_episodes($show->id)->orderBy("epn", "DESC")->skip($e_page * $e_max)->limit($e_max)->get();
        $episodesCount = Episode::show_episodes($show->id)->count();

        $reviewQuery = Review::show_reviews($show->id)->where("user_id", "!=", $user ? $user->id : "");
        $reviews = $reviewQuery->skip($r_page * $r_max)->limit($r_max)->get();
        $reviewsCount = Review::show_reviews($show->id)->count();

        $latestCelebrities = $show->celebrities()->limit(3)->get();
        $actors = $show->celebrities()->whereHas("celebrity", function ($celebrity)  {
            $celebrity->where("role", "=", "actor");
        })->get();
        $directors = $show->celebrities()->whereHas("celebrity", function ($celebrity)  {
            $celebrity->where("role", "=", "director");
        })->get();
        $writers = $show->celebrities()->whereHas("celebrity", function ($celebrity)  {
            $celebrity->where("role", "=", "writer");
        })->get();

        $relateds = $show->relateds()->skip($re_page * $re_max)->limit($re_max)->get();
        $relatedCount = $show->relateds()->count();

        $latestReview = Review::show_reviews($show->id)->latest()->first();

        $userReview = $user ? Review::userReview($showID) : null;

        return view("shows/single")->with([
            "show" => $show->populate(),
            "user" => $user,
            "episodes" => $episodes,
            "episodesCount" => $episodesCount,
            "reviews" => $reviews,
            "reviewsCount" => $reviewsCount,
            "e_page" => $e_page,
            "e_max" => $e_max,
            "r_page" => $r_page,
            "r_max" => $r_max,
            "re_page" => $re_page,
            "re_max" => $re_max,
            "userReview" => $userReview,
            "latestReview" => $latestReview,
            "relateds" => $relateds,
            "relatedCount" => $relatedCount,
            "latestCelebrities" => $latestCelebrities,
            "actors" => $actors,
            "writers" => $writers,
            "directors" => $directors
        ]);
    }

    public function shows(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 12;
        $target = $request->input("target");
        $genre = $request->input("genre");

        $query = Show::latest()->select("id", "poster", "title");

        if($genre) $query = $query->whereHas("genres", function ($q) use($genre) {
            $q->where("name", $genre);
        });

        if($target) $query = $query->where("type", $target);
        if($search) $query = $query->where("title", "like", "%" . $request->input("search") . "%");

        $count = $query->count();

        $shows =  $query->skip($page * $max)->take($max)->get();
        $genres = Genre::list();
        
        return view("shows/index")->with([
            "count" => $count,
            "shows" => $shows,
            "search" => $search,
            "page" => $page,
            "max" => $max,
            "target" => $target,
            "genres" => $genres,
            "genre" => $genre
        ]);
    }

    public function favorites(Request $request) {
        $user = Auth::user();
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 12;

        $query = Show::whereHas("favorites", function ($q) use($user) {
            $q->where("user_id", $user->id);
        })->latest()->select("id", "poster", "title", "releaseDate", "description", "runTime", "rating");

        $count = $query->count();

        $shows =  $query->skip($page * $max)->take($max)->get();
        
        return view("profile.favorite")->with([
            "count" => $count,
            "shows" => $shows,
            "page" => $page,
            "max" => $max,
            "f_name" => $user -> f_name,
            "l_name" => $user -> l_name,
            "avatar" => $user -> avatar,
        ]);
    }

    public function rated(Request $request) {
        $user = Auth::user();
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 12;

        $query = Review::where("user_id", "=", $user->id)->latest();

        $count = $query->count();

        $reviews =  $query->skip($page * $max)->take($max)->get();
        
        return view("profile.rated")->with([
            "count" => $count,
            "reviews" => $reviews,
            "page" => $page,
            "max" => $max,
            "f_name" => $user -> f_name,
            "l_name" => $user -> l_name,
            "avatar" => $user -> avatar,
        ]);
    }
}
