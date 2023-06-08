<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Public Routes
Route::middleware(["auth:0"])->group(function () {

    // Route::get("/5521088b870a098c74dd1fbf1605e8e3.txt", function() {
    //     response()->file(public_path("5521088b870a098c74dd1fbf1605e8e3.txt"));
    // });

    // Route::get("/loaderio-5db7f666acd0472a32715a706779b20f.txt", function() {
    //     return "loaderio-5db7f666acd0472a32715a706779b20f";
    // });

    Route::get("/celebrities", "App\Http\Controllers\CelebrityController@celebrities");
    Route::get("/celebrities/{celebrityID}", "App\Http\Controllers\CelebrityController@celebrity");

    Route::get("/episodes", "App\Http\Controllers\EpisodeController@episodes");

    Route::get("/shows", "App\Http\Controllers\ShowController@shows");
    Route::get("/shows/{showID}", "App\Http\Controllers\ShowController@show");

    Route::get("/", "App\Http\Controllers\PageController@HomePage");

    Route::get("/subscription", "App\Http\Controllers\SubscriptionController@subscription");
    
    Route::view("/login", "auth.login");
    
    Route::view("/register", "auth.register");
    Route::post("/register", "App\Http\Controllers\UserController@register");
    Route::post("/login", "App\Http\Controllers\UserController@login");

    Route::get("/logout", "App\Http\Controllers\UserController@logout");
    Route::get("/logout", "App\Http\Controllers\UserController@logout");

    Route::view("/forgot-password", "auth.forgot-password")->name("password.request");
    Route::post("/forgot-password", "App\Http\Controllers\UserController@forgot_password")->name("password.email");

    Route::get("/reset-password/{token}", function ($token) { return view("auth.reset-password", ["token" => $token]); })->middleware("guest")->name("password.reset");
    Route::post("/reset-password", "App\Http\Controllers\UserController@reset_password")->name("password.update");

    Route::view("/admin/login", "admin.auth.login");

    Route::view("/admin/403", "admin.errors.403");

    Route::view("/admin/forgot-password", "admin.auth.forgot-password");
});

// Protected Routes
Route::middleware(["auth:1"])->group(function () {

    Route::post("/review/update", "App\Http\Controllers\ReviewController@update")->middleware(["verified"]);
    Route::post("/review", "App\Http\Controllers\ReviewController@review")->middleware(["verified"]);

    Route::post("/unfavorite", "App\Http\Controllers\FavoriteController@unfavorite")->middleware(["verified"]);
    Route::post("/favorite", "App\Http\Controllers\FavoriteController@favorite")->middleware(["verified"]);

    Route::get("/profile/rated", "App\Http\Controllers\ShowController@rated")->middleware(["verified"]);
    Route::get("/profile/favorite", "App\Http\Controllers\ShowController@favorites")->middleware(["verified"]);
    Route::get("/profile", "App\Http\Controllers\UserController@profile")->middleware(["verified"]);
    Route::post("/profile", "App\Http\Controllers\UserController@edit_profile")->middleware(["verified"]);

    Route::get("/profile/password", "App\Http\Controllers\UserController@password")->middleware(["verified"]);
    Route::post("/profile/password", "App\Http\Controllers\UserController@change_password")->middleware(["verified"]);

    Route::get("/subscription/paiment", "App\Http\Controllers\SubscriptionController@paiment");
    Route::get("/subscription/pay", "App\Http\Controllers\SubscriptionController@pay");

    Route::get("/email/verify/{id}/{hash}", "App\Http\Controllers\UserController@verify")->name("verification.verify");
    Route::get("/profile/verify", "App\Http\Controllers\UserController@verification")->name("verification.notice");
});

// Paid Routes
Route::middleware(["auth:2"])->group(function () {

    Route::get("/episodes/{episodeID}", "App\Http\Controllers\EpisodeController@episode");
    
    Route::get("/videos/{videoID}", "App\Http\Controllers\EpisodeController@video");

    Route::post("/episodes/history", "App\Http\Controllers\HistoryController@countView");
});


// Admin Routes
Route::middleware(["auth:3", "admin.app"])->group(function () {
    Route::get("/admin", "App\Http\Controllers\AnaliticsController@index");

    Route::get("/admin/clients", "App\Http\Controllers\UserController@clients");
    Route::get("/admin/clients/delete/{clientID}", "App\Http\Controllers\UserController@deleteClient");

    Route::get("/admin/shows", "App\Http\Controllers\ShowController@index");
    Route::get("/admin/shows/add", "App\Http\Controllers\ShowController@add");
    Route::post("/admin/shows/add", "App\Http\Controllers\ShowController@create");
    Route::get("/admin/shows/edit/{showID}", "App\Http\Controllers\ShowController@edit");
    Route::post("/admin/shows/edit/{showID}", "App\Http\Controllers\ShowController@update");
    Route::get("/admin/shows/delete/{showID}", "App\Http\Controllers\ShowController@delete");

    Route::get("/admin/episodes", "App\Http\Controllers\EpisodeController@index");
    Route::get("/admin/episodes/add", "App\Http\Controllers\EpisodeController@add");
    Route::post("/admin/episodes/add", "App\Http\Controllers\EpisodeController@create");
    Route::get("/admin/episodes/edit/{showID}", "App\Http\Controllers\EpisodeController@edit");
    Route::post("/admin/episodes/edit/{showID}", "App\Http\Controllers\EpisodeController@update");
    Route::get("/admin/episodes/delete/{showID}", "App\Http\Controllers\EpisodeController@delete");

    Route::get("/admin/celebrities", "App\Http\Controllers\CelebrityController@index");
    Route::get("/admin/celebrities/add", "App\Http\Controllers\CelebrityController@add");
    Route::post("/admin/celebrities/add", "App\Http\Controllers\CelebrityController@create");
    Route::get("/admin/celebrities/edit/{celebrityID}", "App\Http\Controllers\CelebrityController@edit");
    Route::post("/admin/celebrities/edit/{celebrityID}", "App\Http\Controllers\CelebrityController@update");
    Route::get("/admin/celebrities/delete/{celebrityID}", "App\Http\Controllers\CelebrityController@delete");

    Route::post("/video", "App\Http\Controllers\EpisodeController@uploadVideo");
});

