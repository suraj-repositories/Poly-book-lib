<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function index(Request $request){

        $first_id = null;
        if($request->has('first_id')){
            $first_id = $request->first_id;
            session()->flash('first_id', $first_id);
        }
        $contacts = Contact::orderByRaw(
            "CASE WHEN id = ? THEN 0 ELSE 1 END, id DESC",
            [$first_id]
        )->get();


        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Contact::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.contact.contacts', compact('contacts', 'last30days'));
    }
}
