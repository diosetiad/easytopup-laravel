<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::with(['product.galleries', 'user'])
                        ->where('users_id', Auth::user()->id)->get();
        return view('pages.cart',[
            'carts' => $carts,
            'user' => $user
        ]);
    }

    public function delete(Request $request, $id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
