<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TransactionDetail;
use App\User;
use App\Transaction;

class DashboardController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $transactions  = Transaction::where("users_id", Auth::user()->id)->orderBy('id', 'desc')->take(5);

        return view('pages.dashboard', [
            'transaction_data' => $transactions->get(),
            'user' => $user
        ]);
    }
}