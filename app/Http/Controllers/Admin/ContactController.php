<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function index(){
        $contacts = Contact::paginate(10);
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Contact::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.contact.contacts', compact('contacts', 'last30days'));
    }
}
