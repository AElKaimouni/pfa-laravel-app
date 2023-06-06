<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Show;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use getid3;

class EpisodeController extends Controller {

    public function index(Request $request) {

        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 20;

        $query = Episode::latest()->select("id", "show_id", "thumbnail", "title", "epn", "video", "created_at");

        if($search) $query = $query->where("title", "like", "%" . $request->input("search") . "%");

        $count = $query->count();


        $episodes =  $query->skip($page * $max)->take($max)->get();
        
        return view("admin.episodes.index")->with([
            "count" => $count,
            "episodes" => $episodes,
            "search" => $search,
            "page" => $page,
            "max" => $max,
        ]);
    }

    public function add(Request $request) {
        $shows = Show::select("id", "title")->get();

        return view("admin.episodes.add")->with([
            "shows" => $shows
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "show_id" => "required",
            "epn" => ["required", Rule::unique("episodes")->where(function ($query) use ($request) {
                return $query->where("show_id", $request->input("show_id"));
            }),],
            "thumbnail" => "required|image|mimes:jpg,png,jpeg,gif,svg,webp",
            "video" => "required"
        ]);

        $thumbName = time().".".$request->thumbnail->getClientOriginalExtension();
        $request->thumbnail->move(public_path("ethumbnails"), $thumbName);

        $getID3 = new \getID3;
        $file = $getID3->analyze(storage_path("app/videos/" . $request->video));
        $duration = date("H:i:s", $file["playtime_seconds"]);

        $episode = new Episode(array_merge($request->except(["thumbnail"]), [
            "thumbnail" => $thumbName,
            "duration" => $duration
        ]));

        $episode->save();

        return redirect("admin/episodes") -> with("status", "Episode has been created successfuly");
    }

    public function edit($episodeID) {
        $episode = Episode::find($episodeID);
        $shows = Show::select("id", "title")->get();

        return view("admin.episodes.add", [
            "episode" => $episode,
            "shows" => $shows
        ]);
    }

    public function update($episodeID, Request $request) {
        $episode = Episode::find($episodeID);

        $request->validate([
            "title" => "required",
            "description" => "required",
            "show_id" => "required",
            "epn" => ["required", Rule::unique("episodes")->where(function ($query) use ($request, $episode) {
                return $query->where("id", "!=", $episode->id)->where("show_id", $request->input("show_id"));
            }),],
            "thumbnail" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
        ]);

        $additional = [];


        if($request->video) {
            File::delete(storage_path("app/videos/" . $episode->video));

            $getID3 = new \getID3;
            $file = $getID3->analyze(storage_path("app/videos/" . $request->video));
            $duration = date("H:i:s", $file["playtime_seconds"]);

            $additional["video"] = $request->video;
            $additional["duration"] = $duration;
        }

        if($request->thumbnail) {
            $thumbName = time().".".$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path("ethumbnails"), $thumbName);

            File::delete(public_path("ethumbnails") . "/" . $episode -> thumbnail);
        }


        if($request -> thumbnail) $additional["thumbnail"] = $thumbName;

        $episode->update(array_merge($additional, $request -> except(["thumbnail", "video"])));

        return redirect("/admin/episodes")->with("status", "Episode have been updated successfuly");
    }

    public function delete($episodeID) {
        $episode = Episode::find($episodeID);

        File::delete(storage_path("app/videos/" . $episode->video));
        File::delete(public_path("thumbnails") . "/" . $episode -> thumbnail);

        $episode->delete();
        $episode->history()->delete();

        return redirect("/admin/episodes") -> with("status", "Epsiode has been deleted successfuly");
    }

    public function video($videoID) {

        return  response()->file(storage_path("app/videos/" . $videoID));
    }

    public function uploadVideo(Request $request) {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
    
        if (!$receiver->isUploaded()) {
            // file not uploaded
        }
    
        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file

            $videoName = time().".".$file->getClientOriginalExtension();
            Storage::disk("local")->put("videos/" . $videoName, file_get_contents($file));
    
            // delete chunked file
            unlink($file->getPathname());
            return [
                "filename" => $videoName
            ];
        }
    
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            "done" => $handler->getPercentageDone(),
            "status" => true
        ];
    }

    public function episodes(Request $request) {
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 25;

        $query = Episode::latest()->select("id", "thumbnail", "title", "duration");

        $count = $query->count();

        $episodes =  $query->skip($page * $max)->take($max)->get();

        return view("/episodes/index")->with([
            "page" => $page,
            "max" => $max,
            "count" => $count,
            "episodes" => $episodes
        ]);
    }

    public function episode($episodeID) {
        $episode = Episode::find($episodeID);
        $episodes = $episode->siblings()->select("thumbnail", "id", "title", "video", "duration")->get();

        return view("episodes/single")->with([
            "episodes" => $episodes,
            "episode" => $episode,
        ]);
    }
}
