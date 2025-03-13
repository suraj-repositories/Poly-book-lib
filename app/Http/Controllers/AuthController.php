<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleHandler(){
        try{
            $user = Socialite::driver('google')->user();

            dd($user);
            $findUser = User::where('email', $user->email)->first();
            if(!$findUser){
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->password = Hash::make(Str::rand(12));
                $findUser->role = 'USER';
                $findUser->save();
            }
            Auth::login($findUser);
            return redirect()->route('login');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function githubLogin(){
        return Socialite::driver('github')->redirect();
    }

    public function githubHandler(Request $request){
        try{
            $user = Socialite::driver('github')->user();
            $findUser = User::where('email', $user->email)->first();

            if(!$findUser){
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->image = $user->avatar;
                $findUser->password = Hash::make(Str::rand(12));
                $findUser->role = 'USER';
                $findUser->save();
            }

            Auth::login($findUser);
            return redirect()->route('login');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function facebookPage(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect(){
        try{
             $user = Socialite::driver('facebook')->user();
             $findUser = User::where('email', $user->email)->first();

             if(!$findUser){
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->password = Hash::make(Str::rand(12));
                $findUser->role = 'USER';
                $findUser->save();
            }

            Auth::login($findUser);
            return redirect()->route('login');
        }catch(Exception $e){
             dd('Something went wrong!! : ' . $e->getMessage() );
        }
     }


}
