<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Cart;
use Auth;
use App\Models\Whislist;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){
        $product = Products::find($id);

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name, 
                'qty' => $request->qty, 
                'price' => $product->selling_price, 
                'weight' => 1, 
                'options' => ['image' => $product->product_thumbnail]
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name, 
                'qty' => $request->qty, 
                'price' => $product->discount_price, 
                'weight' => 1, 
                'options' => ['image' => $product->product_thumbnail]
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }
    }

    public function addMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function removeMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully removed from your cart']);
    }

    public function addToWishlist(Request $request, $product_id){
        if(Auth::check()){
            $exists = Whislist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if(!$exists){
                Whislist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => carbon::now()
                ]);
                return response()->json(['success' => 'Successfully added on your wishlist']);
            }else{
                return response()->json(['error' => 'Already added on your wishlist']);
            }
        }else{
            return response()->json(['error' => 'At first login your account']);
        }
    }

}
