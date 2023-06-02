<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class HistoryController extends Controller {
    public function countView(Request $request) {
        $user = Auth::user();
        $episode_id = $request->id;

        $history = new History([
            "user_id" => $user -> id,
            "episode_id" => $episode_id
        ]);

        $history->save();

        return response()->json([], 200);
    }
}
