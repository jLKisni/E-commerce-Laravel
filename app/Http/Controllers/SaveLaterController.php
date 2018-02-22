<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveLaterController extends Controller
{

    //Add Save Later to Cart function

    public function toCart($id){


        $item = Cart::instance('saveforlater')->get($id);

        Cart::instance('saveforlater')->remove($id);

        Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate("App\Product");

        return redirect()->route('cart.index')->with('success_msg','Item was added to cart');

    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveforlater')->remove($id);

        return back()->with('success_msg','Your Saved Item Successfuly Removed!');
    }
}
