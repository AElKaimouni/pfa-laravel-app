<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    use HasFactory;
    protected $table = "show_genres";
    protected $guarded = [];

    public function show() {
        return $this->belongsTo(Show::class);
    }

    static function list() {
        return Genre::select('name')->distinct()->get()->map(function ($genre) {
            return $genre -> name;
        });
    }

    static function popularGeneres() {
        return DB::table('shows')
            ->join('show_genres', 'shows.id', '=', 'show_genres.show_id')
            ->join('episodes', 'shows.id', '=', 'episodes.show_id')
            ->join("history", "history.episode_id", "=", "episodes.id")
            ->groupBy('show_genres.id')
            ->select('show_genres.*', DB::raw('count(*) as count'))
            ->orderBy('count', 'desc')
            ->limit(5)->get();
    }
}
