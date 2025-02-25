<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function loginPage(){
        return view("auth.login");
    }
    public function registerPage(){
        return view("auth.register");
    }

    public function login(Request $request){

        $validated = $request->validate([
            'email'=> 'email|required',
            'password'=>'required|min:3'
        ]);

        $user = User::where('email',$validated['email'])->first();
        if($user && Hash::check($validated['password'], $user->password)){
            Auth::login($user);

            if($user->role == "ADMIN"){
                return redirect()->route('admin.dashboard')->with('success', 'Login successfull!');
            }

            return redirect("/")->with('success', 'Login successfull!');
        }
        return redirect('/login')->with('error', 'Wrong Credentials');
    }

    public function register(Request $request){

        $validated = $request->validate([
            'name'=> 'required|min:3|max:255',
            'terms'=> 'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make( $validated['password']),
            'role' => 'USER'
        ]);

        try{
            if(Settings::get('registration_mail', 'off') == 'on'){
                Mail::to($validated['email'])->send(new RegistrationMail());
            }
        }catch(\Exception $e){
            Log::error('Error sending mail : ' . $e->getMessage());
        }

        Auth::login($user);
        return redirect("/")->with('message', 'Regestration successful!');
    }

    public function logout(){
       if(Auth::check()){
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful!');
       }
       return redirect('/');
    }

}
