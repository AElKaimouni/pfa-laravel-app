<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Request $request) {
        $user = Auth::user();

        $favorite = new Favorite([
            "show_id" => $request -> input("show"),
            "user_id" => $user -> id
        ]);

        $favorite -> save();

        return response()->json([], 200);
    }

    public function unfavorite(Request $request) {
        $user = Auth::user();

        Favorite::where("user_id", "=", $user->id)
                ->where("show_id", "=", $request -> input("show"))
        ->delete();

        return response()->json([], 200);
    }
}
