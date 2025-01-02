<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

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
        return response()->json('incremented');
    }

    public function decrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('decremented');
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json('removed');
    }
}
