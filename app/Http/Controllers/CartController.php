<?php

namespace App\Http\Controllers;


use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
         $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

         Cart::update($id,$request->quantity);

         session()->flash('success_msg','Item quantity was updated Successfully');
         return response()->json(['success'=> true]);
       
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
