<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class LandingpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::inRandomOrder()->take(8)->get(); // with no featured
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get(); // with featured
        return view('landing-page')->with('products', $products);
    }
}
