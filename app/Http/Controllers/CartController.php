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

        // dd(Cart::content());
        $duplicates = Cart::search(function($cartItem,$rowId)use($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_msg','This item is already in the cart');
        }

        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');

        return redirect()->route('cart.index')->with('success_msg','Successfully Added Into Cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_msg','Item Successfully Removed');
    }

 

    public function removeCart(){
        Cart::destroy();

        return redirect()->route('cart.index')->with('success_msg','Successfully Remove');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function SaveForLater($id){

        $item = Cart::get($id);

        Cart::remove($id);

        

        Cart::instance('saveforlater')->add($item->id,$item->name,1,$item->price)->associate("App\Product");

        return redirect()->route('cart.index')->with('success_msg','Item was added to save for later');
    }
}
