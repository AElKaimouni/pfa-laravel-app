<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "f_name",
        "l_name",
        "avatar"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    /**
     * check if user has valid subscription
     * 
     * @return Boolean
     */

    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail); // my notification
    }
    public function hasValidSubscription() {
        
        return Subscription::checkUser($this["id"]);
    }

    public function subscription() {
        return $this->hasOne(Subscription::class)->whereRaw("Date(expire_date) > CURDATE()");
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function history(): HasMany {
        return $this->hasMany(History::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    static function periodCount($t1, $t2) {

        return User::whereBetween("created_at", [date("Y-m-d", strtotime($t1)), date("Y-m-d", strtotime($t2))])->count();
    }

    static function monthlyUsers() {
        return [
            User::periodCount("first day of January", "first day of February"),
            User::periodCount("first day of February", "first day of march"),
            User::periodCount("first day of march", "first day of April"),
            User::periodCount("first day of April", "first day of May"),
            User::periodCount("first day of May", "first day of June"),
            User::periodCount("first day of June", "first day of July"),
            User::periodCount("first day of July", "first day of August"),
            User::periodCount("first day of August", "first day of September"),
            User::periodCount("first day of September", "first day of October"),
            User::periodCount("first day of October", "first day of November"),
            User::periodCount("first day of November", "first day of December"),
            User::periodCount("first day of December", "first day of January next year"),
        ];
    }

    static function recomendation($limit = 10) {
        $user = Auth::user();

        $recomnedation = $user ? DB::select(DB::raw(
            "SELECT shows.* FROM shows
            INNER JOIN show_genres ON show_genres.show_id = shows.id
            WHERE (
                show_genres.name IN (
                    SELECT DISTINCT show_genres.name
                    FROM shows
                    INNER JOIN episodes ON shows.id = episodes.show_id
                    INNER JOIN history ON history.episode_id = episodes.id
                    INNER JOIN show_genres ON show_genres.show_id = shows.id
                    WHERE history.user_id = '$user->id'
                )
            OR
                shows.id IN (
                    SELECT show_related.related_id from show_related
                    WHERE show_related.show_id IN (
                        SELECT shows.id
                        FROM shows
                        INNER JOIN episodes ON shows.id = episodes.show_id
                        INNER JOIN history ON episodes.id = history.episode_id
                        WHERE history.user_id = '$user->id'
                    )
                )
            )
            AND shows.id NOT IN (
                SELECT shows.id
                FROM shows
                INNER JOIN episodes ON shows.id = episodes.show_id
                INNER JOIN history ON episodes.id = history.episode_id
                WHERE history.user_id = '$user->id'
            )
            GROUP BY shows.id
            LIMIT $limit;"
        )) : [];

        $length = count($recomnedation);

        if($length < $limit)
            $recomnedation = array_merge($recomnedation, Show::mostPopularShows($limit - $length, array_map(function($show) {
                return $show->id;
            }, $recomnedation)));

        $recomnedation = array_map(function($show) {
            return new Show(json_decode(json_encode($show), true));
        }, $recomnedation);

        return $recomnedation;
    }
}
