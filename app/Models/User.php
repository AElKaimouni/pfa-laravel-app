<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;
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
}
