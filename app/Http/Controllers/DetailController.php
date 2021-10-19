<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Review;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::with(['galleries'])->where('slug', $id)->firstOrFail();
        $review = Review::with(['product', 'user'])->where('products_id', $product->id)->get();
        $total_review = Review::with(['product', 'user'])->where('products_id', $product->id)->whereNotNull('description')->count();
        $total_rating = Review::with(['product', 'user'])->where('products_id', $product->id)->sum('stars');


        return view('pages.detail', [
            'product' => $product,
            'user' => $user,
            'review' => $review,
            'total_review' => $total_review,
            'total_rating' => $total_rating
        ]);
    }

    public function add(Request $request, $id){
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
