<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller {
    protected $plans = [
        [
            "name" => "FAN",
            "amount" => "49.99",
            "period" => "month",
            "features" => ["No Ads", "Watching TV Shows & Films"],
            "non_featues" => ["Download Episodes"],
            "type" => "fan"
        ],
        [
            "name" => "MEGA FAN",
            "amount" => "69.99",
            "period" => "month",
            "features" => ["No Ads", "Watching TV Shows & Films", "Download Episodes"],
            "non_featues" => [],
            "type" => "mega_fan"
        ],
        [
            "name" => "MEGA FAN (YEAR)",
            "amount" => "499.99",
            "period" => "year",
            "features" => ["No Ads", "Watching TV Shows & Films", "Download Episodes"],
            "non_featues" => [],
            "type" => "mega_fan"
        ]
    ];

    public function pay(Request $request) {
        $planID = $request -> input("plan");
        $plan = $this -> plans[$planID];
        $user = Auth::user();

        $sub = new Subscription([
            "user_id" => $user -> id,
            "amount" => $plan["amount"],
            "expire_date" => date("Y-m-d", strtotime("+1 " . $plan["period"], strtotime(date("Y-m-d")))),
            "type" => $plan["type"]
        ]);

        $sub -> save();

        return redirect("/");
    }

    public function paiment(Request $request) {
        $planID = $request -> input("plan");

        return View("paiment")->with([
            "plan" => $this -> plans[$planID],
            "index" => $planID
        ]);
    }

    public function subscription() {
        return View("subscription")->with([
            "plans" => $this -> plans
        ]);
    }
}
