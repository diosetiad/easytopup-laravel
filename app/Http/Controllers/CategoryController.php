<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(32);

        return view('pages.category',[
             'categories' => $categories,
            'products' => $products,
            'user' => $user
        ]);
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail(Request $request, $slug)
    {
        $user = Auth::user();
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(32);

        return view('pages.category',[
             'categories' => $categories,
            'products' => $products,
            'user' => $user
        ]);
    }
}
