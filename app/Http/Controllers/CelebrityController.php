<?php

namespace App\Http\Controllers;

use App\Models\Celebrity;
use Illuminate\Support\Facades\File;


use Illuminate\Http\Request;

class CelebrityController extends Controller {
    public function index(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 20;
        $target = $request->input("target");

        $query = Celebrity::latest()->select("id", "avatar", "fullName", "country", "role", "birthDay", "keywords", "created_at");

        if($target) $query = $query->where("role", $target);
        if($search) $query = $query->where("fullName", "like", "%" . $request->input("search") . "%");

        $count = $query->count();
        $directorsCount = (clone $query)->where("role", "director")->count();
        $writersCount = (clone $query)->where("role", "writer")->count();
        $actorsCount = (clone $query)->where("role", "actor")->count();

        $celebrities =  $query->skip($page * $max)->take($max)->get();
        
        return view("admin.celebrities.index")->with([
            "count" => $count,
            "directorsCount" => $directorsCount,
            "writersCount" => $writersCount,
            "actorsCount" => $actorsCount,
            "celebrities" => $celebrities,
            "search" => $search,
            "page" => $page,
            "max" => $max,
            "target" => $target
        ]);
    }

    public function add() {

        return view("admin.celebrities.add");
    }

    public function edit($celebrityID) {
        $celebrity = Celebrity::find($celebrityID);

        return view("admin.celebrities.add", [
            "celebrity" => $celebrity
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            "fullName" => "required",
            "biography" => "required",
            "keywords" => "required",
            "avatar" => "required|image|mimes:jpg,png,jpeg,gif,svg,webp",
            "role" => "required",
            "country" => "required",
            "birthDay" => "required|date"
        ]);

        $avatarName = time().".".$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path("cavatars"), $avatarName);

        $celebrity = new Celebrity(array_merge($request->except(["avatar"]), [
            "avatar" => $avatarName,
        ]));

        $celebrity->save();

        return redirect("admin/celebrities") -> with("status", "Celebrity has been created successfuly");
    }

    public function update($celebrityID, Request $request) {
        $request->validate([
            "fullName" => "required",
            "biography" => "required",
            "keywords" => "required",
            "avatar" => "image|mimes:jpg,png,jpeg,gif,svg,webp",
            "role" => "required",
            "country" => "required",
            "birthDay" => "required|date"
        ]);

        $celebrity = Celebrity::find($celebrityID);

        if($request->avatar) {
            $avatarName = time().".".$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path("cavatars"), $avatarName);
            File::delete(public_path("cavatars") . "/" . $celebrity -> avatar);
        } else {
            $avatarName = $celebrity-> avatar;
        }

        $celebrity->update(array_merge($request->except(["avatar"]), [
            "avatar" => $avatarName,
        ]));

        $celebrity->save();

        return redirect("/admin/celebrities") -> with("status", "Celebrity has been updated successfuly");
    }

    public function delete($celebrityID) {
        $celebrity = Celebrity::find($celebrityID);

        File::delete(public_path("cavatars") . "/" . $celebrity -> avatar);

        $celebrity->delete();

        return redirect("/admin/celebrities") -> with("status", "Celebrity has been deleted successfuly");
    }

    public function celebrities(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 12;
        $target = $request->input("target");

        $query = Celebrity::latest()->select("id", "avatar", "fullName", "country", "role");


        if($target) $query = $query->where("role", $target);
        if($search) $query = $query->where("fullName", "like", "%" . $request->input("search") . "%");

        $count = $query->count();

        $celebrities =  $query->skip($page * $max)->take($max)->get();
        
        return view("celebrities.index")->with([
            "count" => $count,
            "celebrities" => $celebrities,
            "search" => $search,
            "page" => $page,
            "max" => $max,
            "target" => $target
        ]);
    }

    public function celebrity($celebrityID) {
        $celebrity = Celebrity::find($celebrityID);
        $shows = $celebrity->shows()->get();
        $count = $celebrity->shows()->count();

        return view("celebrities.single")->with([
            "celebrity" => $celebrity,
            "shows" => $shows,
            "count" => $count
        ]);
    }
}
