<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

class CartPageController extends Controller
{
    public function getMycart()
    {
        return view('frontend.mycart.view_mycart');
    }

    public function getCartData()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        return response()->json(['carts' => $carts, 'cartQty' => $cartQty, 'cartTotal' => $cartTotal]);
    }

    public function increment($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if(Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

                $total = (int)str_replace(',', '', Cart::subtotal());
                session()->put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => $total * $coupon->coupon_discount / 100,
                    'total_amount' => $total - ($total * $coupon->coupon_discount / 100),
                ]);
        }
        return response()->json('incremented');
    }

    public function decrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if(Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

                $total = (int)str_replace(',', '', Cart::subtotal());
                session()->put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => $total * $coupon->coupon_discount / 100,
                    'total_amount' => $total - ($total * $coupon->coupon_discount / 100),
                ]);
        }
        return response()->json('decremented');
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);

        if(Session::has('coupon')) {
            Session::forget('coupon');
        }
        return response()->json('removed');
    }
}
