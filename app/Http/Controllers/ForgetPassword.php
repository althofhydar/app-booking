<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPassword extends Controller
{
    function forgetPassword(){
        return view(view: "forget-password");
    }

    function forgetPasswordPost(Request $request) {
        $request->validate([
            'email'=> "required|email|exists:users",
        ]);

        $token = Str::random(length: 64);

        DB::table('password_resets')->insert([
           'email' => $request->email,
           'token' => $token,
           'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($messege) use ($request){
            $messege->to($request->email);
            
            $messege->subject("Reset Password");
        });

        return redirect()->to(route("forget.password"))->with("success", "We have send an email to reset password.");

    }

    function resetPassword($token){
      return view("new-password", compact(var_name: 'token'));
    }

    function resetPasswordPost(Request $request){
        $request->validate([
        "email" => "required|email|exists:users",
        "password" => "required|string|confirmed",
        "password_confirmation" => "required"
        ]);

        $updatePassword = DB::table('password_resets')
        ->where([
            "email" => $request->email,
            "token" => $request->token
        ])->first();
        
        if (!$updatePassword){
            return redirect()->to(route("reset.password"))->with("error", "Invalid");
        }

         User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

         DB::table("password_resets")->where(["email" => $request->email])->delete();

         return redirect()->to(route("login"))->with("success", "Password reset succes");

    }

}
