<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Whislist;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){
        if(Session::has('coupon')) {
            Session::forget('coupon');
        }
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


    public function couponApply(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity','>=', Carbon::now()->format('Y-m-d'))->first();

        if($coupon){

            $total = (int)str_replace(',', '', Cart::subtotal());
            session()->put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $total * $coupon->coupon_discount / 100,
                'total_amount' => $total - ($total * $coupon->coupon_discount / 100),
            ]);
            return response()->json(['success' => 'Coupon applied successfully']);
        }else{
            return response()->json(['error' => 'Coupon has expired']);
        }
    }

    public function couponCalcuation(){
        if(Session::has('coupon')){
            return response()->json([
                'subtotal' => round(Cart::total()),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount']]);
        }else{
            return response()->json([
                'total' => round(Cart::total())
            ]);
        }

    }
    
    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }
}
