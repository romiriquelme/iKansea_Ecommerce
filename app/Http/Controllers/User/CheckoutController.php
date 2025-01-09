<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;


use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Carbon\Carbon;


class CheckoutController extends Controller
{
    public function checkoutDetail(Request $request){

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = (int)str_replace()Cart::subtotal();
        }

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $postCode = $request->post_code;
        $notes = $request->notes;

        $province = Province::where('id', $request->province_id)->first();
        $regency = Regency::where('id', $request->regency_id)->first();
        $district = District::where('id', $request->district_id)->first();
        $village = Village::where('id', $request->village_id)->first();

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => $request->payment_type,
            'transaction_id' => $request->transaction_id,
            'phone' => $request->phone,
            'amount' => $total_amount,
            'invoice_no' => 'MS'.mt_rand(10000000000,99999999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_amount,
            ),
            'customer_details' => array(
                'first_name' => $name,
                'email' => $email,
                'phone' => $phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();
        


        return view('frontend.checkout.detail_checkout', compact('carts', 'name', 'email', 
    'phone', 'province', 'regency', 'district', 'village', 'postcode', 'notes', 'total_amount', 'snapToken', 'order_id'));

    }


    public function checkoutStore(Request $request){
        $id_order = $request->id_order;
        $data = json_decode($request->get('json'));
        Order::findOrFail($id_order)->update([
            'status' => 'Success',
            'payment_type' => $data->payment_type,
            'transaction_id' => $data->transaction_id,
        ]);

        $notification = array(
            'message' => 'Payment Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);
        
    }


    public function myOrders(){
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.view_order', compact('orders'));
    }


    public function OrderDetail($id){

        $order = Order::with('province', 'regency', 'district', 'village')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order_detail', compact('order', 'orderItem'));
    }



    public function downloadInvoice($id){
        $order = Order::with('province', 'regency', 'district', 'village')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.invoice.view_invoice', compact('order', 'orderItem'));
    }
}
