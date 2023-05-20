<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function show(): BelongsTo {
        return $this->belongsTo(Show::class);
    }

    static function show_reviews($show) {
        return Review::where("show_id", "=", $show);
    }

    static function userReview($show) {
        $user = Auth::user();

        return Review::whereRaw("user_id = " . $user->id . " and show_id = $show")->first();
    }
}
