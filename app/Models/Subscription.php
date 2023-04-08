<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
