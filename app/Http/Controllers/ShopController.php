<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pagination = 9;
        $categories = Category::all();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->category);
            });
            // ->get(); removed because we need price sorting on category as well


            $category_name = optional($categories->where('slug', request()->category)->first())->name;

        }else{
            // $products = Product::inRandomOrder()->take(12)->get(); with no pagination
            // $products = Product::inRandomOrder()->take(12);//for random but will not work with price
            // $products = Product::take(12);//will work with price sortings

            // for featured
            $products = Product::where('featured', true);

            $category_name = 'Featured';
        }

        //for price range
        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate(9);
        }elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate(9);
        }else {
            $products = $products->paginate(9);
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'category_name' => $category_name,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightlike = Product::where('slug','!=' ,$slug)->mightLike()->get();

        $stockLevel = getStockLevel($product->quantity);

        return view('product')->with([
            'product' => $product,
            'mightlike' => $mightlike,
            'stockLevel' => $stockLevel,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3'
        ]);

        $query = $request->input('query');
        // dd($query);

        // $products = Product::where('name', 'like', "%$query%")
        //                     ->orWhere('details', 'like', "%$query%")
        //                     ->orWhere('description', 'like', "%$query%")
        //                     ->paginate(10);

        // For nicolaslopezj/searchable

        $products = Product::search($query)->paginate(10);

        // dd($products);

        return view('search-results')->with('products', $products);
    }

    public function searchAlgolia(Request $request)
    {


        return view('search-results-algolia');
    }
}
