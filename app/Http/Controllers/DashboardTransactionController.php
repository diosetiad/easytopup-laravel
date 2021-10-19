<?php

namespace App\Http\Controllers;

use App\Review;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $buyTransactions = Transaction::where("users_id", Auth::user()->id)->orderBy('id', 'desc')->take(10);

        return view('pages.dashboard-transactions',[
            'transaction_data' => $buyTransactions->get(),
            'user' => $user
        ]);
    }

    public function details(Request $request, $id)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $id)->get();
        $transactionDetail = TransactionDetail::where('transactions_id', $transaction[0]->id)->with(['transaction.user', 'product.galleries'])->get();

        $review = Review::with('product')->where('transaction_id', $id)->get();






        return view('pages.dashboard-transactions-details',[
            'user' => $user,
            'transactionDetail' => $transactionDetail,
            'transaction' => $transaction,
            'review' => $review[0]
        ]);
    }

    public function update(Request $request, $id)
    {
        $star = $request->stars;
        $description = $request->description;
        $item = TransactionDetail::where('transactions_id', $id)->get();
        
        for ($i=0; $i < sizeof($item); $i++) { 
            $dataReview = Review::where("transaction_details_id", $item[$i]->id)->update([
                'stars' => $star,
                'description' => $description
            ]);

        }

        return redirect()->route('dashboard-transaction-details', $id);
    }
}
