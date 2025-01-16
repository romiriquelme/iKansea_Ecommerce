<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cart;
use App\Models\Products;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\Province;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Products::findOrFail($id);

        $price = $product->discount_price ?? $product->selling_price;
        
        Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'qty' => $request->qty,
            'price' => $price,
            'weight' => 1,
            'options' => ['image' => $product->product_thumbnail],
        ]);

        return response()->json(['success' => 'Successfully added to your cart']);
    }

    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
    }

    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully removed from your cart']);
    }

    public function addToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->exists();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => 'Successfully added to your wishlist']);
            } else {
                return response()->json(['error' => 'Already added to your wishlist']);
            }
        } else {
            return response()->json(['error' => 'Please login first']);
        }
    }

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if ($coupon) {
            $total = (int)str_replace(',', '', Cart::subtotal());
            $discountAmount = $total * $coupon->coupon_discount / 100;
            $totalAmount = $total - $discountAmount;

            session()->put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
            ]);

            return response()->json(['success' => 'Coupon applied successfully']);
        } else {
            return response()->json(['error' => 'Coupon has expired']);
        }
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => round(Cart::total()),
                'coupon_name' => session('coupon.coupon_name'),
                'coupon_discount' => session('coupon.coupon_discount'),
                'discount_amount' => session('coupon.discount_amount'),
                'total_amount' => session('coupon.total_amount'),
            ]);
        } else {
            return response()->json([
                'total' => round(Cart::total())
            ]);
        }
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon removed successfully']);
    }

    public function checkoutCreate()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $total = Cart::subtotal();
                $provinces = Province::all();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'total', 'provinces'));
            } else {
                return redirect()->to('/')->with([
                    'message' => 'Cart is empty',
                    'alert-type' => 'alert',
                ]);
            }
        } else {
            return redirect()->route('login')->with([
                'message' => 'Please login first',
                'alert-type' => 'error',
            ]);
        }
    }
}
