<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Product;
use App\Banner;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner = Banner::all();
        $user = Auth::user();
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products,
            'user' =>$user,
            'banner' =>$banner
        ]);

    }
}
