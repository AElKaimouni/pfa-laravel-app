<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\AppMailer;

class UserController extends Controller
{
    /**
     * register user
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Route Home page if successed if not login
     */
    static function register(Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) return redirect('/register')
            ->withErrors($validator)
            ->withInput();

        $data = $request->all();

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"])
        ]);

        AppMailer::sendEmail($user -> email);

        return redirect("/");
    }

    /**
     * login the user
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Route Home page if successed if not login
    */
    static function login(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $success = Auth::attempt($request->only("email", "password"), $request -> input("remember"));

        if($success) return redirect("/");
        
        return redirect("login")->withErrors(["Unvalid Credentials"]);
    }

    /**
     * logout user
     * 
     * @return View login
     */
    static function logout() {
        
        Auth::logout();
        return redirect("/login");
    }

    /** 
     * auth user by auth level 
     * [0 : public page]
     * [1 : protected page]
     * [2 : paid page]
     * [3 : admin page]
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Number  $request
     * 
     * @return View of 403 or login or subscribe view or void if auth us successed
     * 
    */
    static function auth($level = 0) {
        $user = Auth::user();

        
        if($level > 0 && !($user instanceof User)) {
            echo "$level > 0 && !(user instanceof User)";

            return redirect("/login");
        } else if ($level > 0 && $user instanceof User) {

            if($level === 2 && !$user->hasValidSubscription()) {

                return redirect("/subscription");
            }
    
            if($level === 3 && $user["role"] !== "admin") {

                return redirect("/403");
            }
        }

    }

}
