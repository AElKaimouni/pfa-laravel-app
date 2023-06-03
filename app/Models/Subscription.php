<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;
    protected $table = "subscriptions";
    protected $guarded = [];

    /**
     * check if a user has an active subscription
     * 
     * @param user_id
     * 
     * @return Boolean
     */

    static function checkUser($user_id) {
        $res = Subscription::whereRaw("user_id = '$user_id' AND Date(expire_date) > CURDATE()")->first();

        if($res) return true; else return false;
    }

    static function periodCount($t1, $t2) {

        return Subscription::whereBetween("created_at", [date("Y-m-d", strtotime($t1)), date("Y-m-d", strtotime($t2))])->count();
    }

    static function periodRevenue($t1, $t2) {
        return Subscription::whereBetween("created_at", [date("Y-m-d", strtotime($t1)), date("Y-m-d", strtotime($t2))])->sum("amount");
    }


    static function yearRevenue() {
        return [
            Subscription::periodRevenue("first day of January", "first day of February"),
            Subscription::periodRevenue("first day of February", "first day of march"),
            Subscription::periodRevenue("first day of march", "first day of April"),
            Subscription::periodRevenue("first day of April", "first day of May"),
            Subscription::periodRevenue("first day of May", "first day of June"),
            Subscription::periodRevenue("first day of June", "first day of July"),
            Subscription::periodRevenue("first day of July", "first day of August"),
            Subscription::periodRevenue("first day of August", "first day of September"),
            Subscription::periodRevenue("first day of September", "first day of October"),
            Subscription::periodRevenue("first day of October", "first day of November"),
            Subscription::periodRevenue("first day of November", "first day of December"),
            Subscription::periodRevenue("first day of December", "first day of January next year"),
        ];
    }

    static function typesCount() {
        return [
            Subscription::where("amount", "=", "49.99")->count(),
            Subscription::where("amount", "=", "69.99")->count(),
            Subscription::where("amount", "=", "499.99")->count()
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
