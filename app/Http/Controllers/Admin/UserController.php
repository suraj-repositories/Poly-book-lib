<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::orderBy('id', 'desc')->where('role', 'user')->get();
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = User::whereBetween('created_at', [$startDate, $endDate])->where('role', 'user')->count();
        return view('admin.users.users', compact('users', 'last30days'));
    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }
}
