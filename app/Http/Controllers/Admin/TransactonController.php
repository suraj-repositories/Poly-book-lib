<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactonController extends Controller
{
    //
    public function index(){
        $transactions = Transaction::orderBy('id', 'desc')->get();
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Transaction::whereBetween('created_at', [$startDate, $endDate])->count();

        $totalSuccessAmount = Transaction::where('status', 'completed')->sum('amount');
        $totalAmount = Transaction::sum('amount');
        return view('admin.transaction.transactions', compact('transactions', 'last30days' ,'totalSuccessAmount', 'totalAmount'));

    }
}
