<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Str;

class SocialMediaLoginController extends Controller
{
    //

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandler()
    {
        try {
            $user = Socialite::driver('google')->user();

            dd($user);
            $findUser = User::where('email', $user->email)->first();
            if (!$findUser) {
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->password = Hash::make(Str::rand(12));
                $findUser->role = 'USER';
                $findUser->save();
            }
            Auth::login($findUser);
            return redirect()->route('login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubHandler(Request $request)
    {
        try {
            $user = Socialite::driver('github')->user();
            $findUser = User::where('email', $user->email)->first();

            if (!$findUser) {
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
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function facebookPage()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('email', $user->email)->first();

            if (!$findUser) {
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->password = Hash::make(Str::rand(12));
                $findUser->role = 'USER';
                $findUser->save();
            }

            Auth::login($findUser);
            return redirect()->route('login');
        } catch (Exception $e) {
            dd('Something went wrong!! : ' . $e->getMessage());
        }
    }
}
