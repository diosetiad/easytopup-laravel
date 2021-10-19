<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_cost');
        $transaction = Transaction::count();
        $transaction_data = Transaction::orderBy('id','desc')->take(5)->get();

        return view('pages.admin.dashboard',[
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_data' => $transaction_data
        ]);

    }

    public function details(Request $request, $id)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $id)->get();
        $transactionDetail = TransactionDetail::where('transactions_id', $transaction[0]->id)->with(['transaction.user', 'product.galleries'])->get();


        return view('pages.admin.transaction-details',[
            'user' => $user,
            'transactionDetail' => $transactionDetail,
            'transaction' => $transaction
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $transaction = Transaction::findOrFail($id);



        $item = TransactionDetail::where('transactions_id', $id)->get();

        for ($i=0; $i < count($item) ; $i++) { 
            $item[$i]->update($data);
        }


        $transaction->update(['transaction_status' => 'SUCCESS']);
       
        return redirect()->route('admin-transaction-details', $id);
    }
}
