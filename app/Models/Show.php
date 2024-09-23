<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Show extends Model {
    use HasFactory;
    protected $table = "shows";
    protected $guarded = [];

    public function episodes(): HasMany {
        return $this->hasMany(Episode::class);
    }

    public function genres(): HasMany {
        return $this->hasMany(Genre::class);
    }

    public function editGenres($genres) {
        $this -> genres()->delete();
            
        if($genres) $this -> genres() -> createMany(array_map(function($gerne) {
            return [
                "name" => $gerne,
                "show_id" => $this->id
            ];
        }, explode(",", $genres)));
    }

    public function celebrities(): HasMany {
        return $this->hasMany(ShowCelebrity::class);
    }

    public function editCelebrities($celebrities) {
        $this -> celebrities()->delete();
            
        $this -> celebrities() -> createMany(array_map(function($role, $id) {
            return [
                "role" => $role,
                "show_id" => $this->id,
                "celebrity_id" => $id
            ];
        }, $celebrities, array_keys($celebrities)));
    }

    public function getGenres() {
        return $this->genres()->get()->map(function ($genre) {
            return $genre -> name;
        })->toArray();
    }

    public function relateds(): HasMany {
        return $this->hasMany(Related::class);
    }

    public function relatedsList() {
        return $this->relateds()->get()->map(function ($related) {
            return $related -> related_id;
        });;
    }

    public function editRelateds($relateds) {
        $this -> relateds()->delete();
            
        if($relateds) $this -> relateds() -> createMany(array_map(function($related) {
            return [
                "related_id" => $related,
                "show_id" => $this->id
            ];
        }, explode(",", $relateds)));
    }

    public function favorites(): HasMany {
        return $this->hasMany(Favorite::class);
    }

    public function isFavorite() {
        $user = Auth::user();

        if(!$user) return false;

        $favorite = $this -> favorites() -> where("user_id", $user->id)->first();

        if($favorite) return true;

        return false;
    }

    public function genre($genre) {
        return $this->hasOne(Genre::class)->where("name", $genre);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function rating() {
        $rating =  $this->reviews->avg("rating");

        return $rating ? number_format($rating, 1, ".", "") : "Na";
    }

    public function populate() {
        
        return array_merge($this->toArray(), [
            "genres" => $this->getGenres(),
            "favorite" =>  $this->isFavorite(),
            "userRating" => $this->rating(),
            "userRating_num" => $this->reviews->avg("rating")
        ]);
    }

    static function mostPopularShows($limit = 5, $ignore = []) {
        $res = DB::table('shows')
            ->join('episodes', 'shows.id', '=', 'episodes.show_id')
            ->join("history", "history.episode_id", "=", "episodes.id")
            ->groupBy('shows.id')
            ->select('shows.*', DB::raw('count(*) as count'))
            ->orderBy('count', 'desc')
            ->whereNotIn("shows.id", $ignore)
            ->limit($limit)->get();

        $length = count($res);

        if($length < $limit) $res = array_merge($res->toArray(), DB::table('shows')->whereNotIn("shows.id", $res->map(function($show) {
            return $show->id;
        }))->limit($limit - $length)->get()->toArray());
        
        else return $res->toArray();

        return $res;
    }
}
