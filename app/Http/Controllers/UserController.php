<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\Subscription;

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
            "password" => "required|confirmed|min:6",
        ]);

        if ($validator->fails()) return redirect("/register")
            ->withErrors($validator)
            ->withInput();

        $data = $request->all();
        $count = User::count();

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "role" => $count == 0 ? "admin" : "user",
        ]);

        Auth::login($user);

        return redirect("/profile");
    }

    /**
     * verify user email
     * @param Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * 
     * @return View home
     */

    static function verify(EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect("/");
    }

    static function verification() {
        $user = Auth::user();

        if($user instanceof User && !$user->hasVerifiedEmail()) {

            $user->sendEmailVerificationNotification();
            return view("auth.verification");
        } else if($user instanceof User && $user->hasVerifiedEmail()) return redirect("/profile");
        else return redirect("/login");
    }

    static function forgot_password(Request $request) {
        $request->validate(["email" => "required|email"]);
 
        $status = Password::sendResetLink(
            $request->only("email")
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(["status" => __($status)])
                    : back()->withErrors(["email" => __($status)]);
    }

    static function reset_password(Request $request) {
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|min:8|confirmed",
        ]);
        
        $status = Password::reset(
            $request->only("email", "password", "password_confirmation", "token"),
            function ($user, $password) {
                $user->forceFill([
                    "password" => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect("/login")->with("status", __($status))
                    : back()->withErrors(["email" => [__($status)]]);
    }

    /**
     * login the user
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Route Home page if successed if not login
    */
    static function login(Request $request, ) {

        if(Auth::user()) return redirect("/");

        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $success = Auth::attempt($request->only("email", "password"), $request -> input("remember"));

        if($success) {

            return back();
        }
        
        return back()->withErrors(["Unvalid Credentials"]);
    }

    /**
     * logout user
     * 
     * @return View login
     */
    static function logout() {
        
        Auth::logout();
        
        return back();
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

            if($level === 3) return response()->view("admin.auth.login");

            return response()->view("auth.login");
        } else if ($level > 0 && $user instanceof User) {

            if($level === 2 && !$user->hasValidSubscription()) {

                return redirect("/subscription");
            }
    
            if($level === 3 && $user["role"] !== "admin") {

                return response()->view("admin.errors.403");
            }
        }

    }

    static function profile(Request $request) {
        $user = Auth::user();

        return view("profile.index")->with([
            "f_name" => $user -> f_name,
            "l_name" => $user -> l_name,
            "username" => $user -> name,
            "email" => $user -> email,
            "avatar" => $user -> avatar
        ]);
    }

    static function edit_profile(Request $request) {
        $request->validate([
            "email" => "required|email",
            "name" => "required",
            "f_name" => "",
            "l_name" => "",
            "avatar" => "image|mimes:jpg,png,jpeg,gif,svg",
        ]);

        $user = Auth::user();
        if($request->avatar) {
            $avatarName = time().".".$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path("avatars"), $avatarName);
        }

        if($user instanceof User)
        $user -> update(array_merge($request->avatar ? [
            "avatar" => $avatarName
        ] : [], $request->only(["email", "name", "f_name", "l_name"])));

        return redirect("/profile");
    }

    static function password(Request $request) {
        $user = Auth::user();

        return view("profile.password")->with([
            "f_name" => $user -> f_name,
            "l_name" => $user -> l_name,
            "avatar" => $user -> avatar
        ]);
    }

    static function change_password(Request $request) {
        $request->validate([
            "old_password" => "required",
            "new_password" => "required|confirmed",
        ]);

        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password)){
            return back()->withErrors(["Old Password Doesn't match!"]);
        }

        if($user instanceof User) $user->update([
            "password" => Hash::make($request->new_password)
        ]);


        return back()->with("status", "Password changed successfully!");
    }

    public function clients(Request $request) {
        $search = $request->input("search");
        $page = $request->input("page") ?: 0;
        $max = $request->input("max") ?: 20;
        $target = $request->input("target") ?: "all";

        $query = User::where("role", "user")->with("subscription")->select("name","email", "id", "created_at", "avatar", "email_verified_at");
        
        switch($target) {
            case "verified": $query = $query->whereRAW("email_verified_at IS NOT NULL"); break;
            case "subscribed": $query = $query->has("subscription");
        }

        if($search) {
            $query = $query->where("name", "like", "%" . $request->input("search") . "%");
        }

        $count = $query->count();
        $verifiedCount = (clone $query)->whereRAW("email_verified_at IS NOT NULL")->count();
        $subCount = (clone $query)->has("subscription")->count();

        $clients = $query->skip($page * $max)->take($max)->get();

        $data = [
            "clients" => $clients,
            "count" => $count,
            "max" => $max,
            "page" => $page,
            "subCount" => $subCount,
            "verifiedCount" => $verifiedCount,
            "search" => $search
        ];

        return view("admin.clients.index") -> with($data);
        
    }

    public function deleteClient($clientID) {
        $client = User::find($clientID);
        
        if($client->role === "admin") return back()->withErrors([
            "status" => "Cannot remove Admin user"
        ]);

        $client->subscriptions()->delete();
        $client->favorites()->delete();
        $client->reviews()->delete();
        $client->history()->delete();
        
        $client->delete();

        return redirect("/admin/clients") -> with("status", "Client has been deleted successfuly");
    }

    
}
