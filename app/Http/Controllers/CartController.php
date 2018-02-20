<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightlike = Product::inRandomOrder()->take(4)->get();

        return view('cart')->with('mightlike',$mightlike);
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');

        return redirect()->route('cart.index')->with('success_msg','Successfully Added Into Cart');
    }

 

    public function removeCart(){
        Cart::destroy();

        return redirect()->route('cart.index')->with('success_msg','Successfully Remove');
    }
}
