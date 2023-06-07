<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Show;
use App\Models\Genre;

class AnaliticsController extends Controller {
    public function index() {
        $monthViews = History::viewsCount("first day of this month", "+1 month");
        $todayViews = History::viewsCount("today", "tomorrow");
        $monthUsers = User::periodCount("first day of this month", "+1 month");
        $todayUsers = User::periodCount("today", "tomorrow");
        $monthSubs = Subscription::periodCount("first day of this month", "+1 month");
        $todaySubs = Subscription::periodCount("today", "tomorrow");
        $monthRevenue = Subscription::periodRevenue("first day of this month", "+1 month");
        $todayRevenue = Subscription::periodRevenue("today", "tomorrow");

        $yearRevenue = Subscription::yearRevenue();
        $subsTypesCount = Subscription::typesCount();

        $topShows = Show::mostPopularShows(4);
        $topGenres = Genre::popularGeneres();
        $latestClients = User::where("role" , "=", "user")->limit(5)->latest()->get();

        $monthlyViews = History::monthlyViews();
        $monthlyUsers = User::monthlyUsers();

        $latestSubs = Subscription::latest()->limit(10)->get();

        return view("admin.index")->with([
            "todayViews" => $todayViews,
            "monthViews" => $monthViews,
            "monthUsers" => $monthUsers,
            "todayUsers" => $todayUsers,
            "monthSubs" => $monthSubs,
            "todaySubs" => $todaySubs,
            "monthRevenue" => $monthRevenue,
            "todayRevenue" => $todayRevenue,
            "yearRevenue" => $yearRevenue,
            "subsTypesCount" => $subsTypesCount,
            "topShows" => $topShows,
            "topGenres" => $topGenres,
            "latestClients" => $latestClients,
            "monthlyViews" => $monthlyViews,
            "monthlyUsers" => $monthlyUsers,
            "latestSubs" => $latestSubs
        ]);
    }
}
