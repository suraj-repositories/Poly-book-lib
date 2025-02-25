<?php

namespace App\Http\Controllers\Web;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintainenceController extends Controller
{
    //
    public function index(){

        if(Settings::get('maintainence_mode', 'off') != 'on'){
            return redirect()->route('home');
        }
        return view('web.maintainence.under_maintainence');
    }
}
