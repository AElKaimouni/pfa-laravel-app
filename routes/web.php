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

Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    Mail::to('abderrahmane.elkaimouni@etu.uae.ac.ma')->send(new \App\Mail\AppMailer($details));
   
    dd("Email is Sent.");
});

// Public Routes
Route::middleware(["auth:0"])->group(function () {

    Route::view("/", "index");

    Route::get("/subscription", "App\Http\Controllers\SubscriptionController@subscription");
    
    Route::view("/login", "auth.login");

    Route::view("/register", "auth.register");

    Route::post("/register", "App\Http\Controllers\UserController@register");

    Route::post("/login", "App\Http\Controllers\UserController@login");

    Route::get("/logout", "App\Http\Controllers\UserController@logout");
});

// Protected Routes
Route::middleware(["auth:1"])->group(function () {
    Route::view("/profile", "profile");

    Route::get("/subscription/paiment", "App\Http\Controllers\SubscriptionController@paiment");

    Route::get("/subscription/pay", "App\Http\Controllers\SubscriptionController@pay");
});

// Paid Routes
Route::middleware(["auth:2"])->group(function () {
    Route::view("/watch", "watch");
    
});

// Admin Routes
Route::middleware(["auth:3"])->group(function () {
    
});