<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller {
    
    public function review(Request $request) {
        $request->validate([
            "title" => "required",
            "rating" => "required|numeric|max:10|min:0",
            "comment" => "required",
            "show_id" => "required"
        ]);

        $user = Auth::user();

        $review = new Review(array_merge($request->only("title", "rating", "comment", "show_id"), [
            "user_id" => $user->id
        ]));

        $review->save();

        return back()->with(["status" => "Your reveiw created successfuly"]);
    }

    public function update(Request $request) {
        $request->validate([
            "title" => "required",
            "rating" => "required|numeric|max:10|min:0",
            "comment" => "required",
            "show_id" => "required"
        ]);

        $review = Review::userReview($request->input("show_id"));

        $review->update($request->only(["title", "rating", "comment"]));

        return back()->with(["status" => "Review updated successfuly"]);
    }
}
