<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function viewCoupon(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.view_coupon', compact('coupons'));
    }

    public function storeCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ],[
            'coupon_name.required' => 'Input Coupon Name ',
            'coupon_discount.required' => 'Input Coupon Discount',
        ]);

        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editCoupon($id){
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }

    public function updateCoupon(Request $request, $id){
        $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|numeric|min:0|max:100',
            'coupon_validity' => 'required|date_format:d/m/Y',
        ]);
    
        Coupon::findOrFail($id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => Carbon::createFromFormat('d/m/Y', $request->coupon_validity)->format(''),
            'updated_at' => Carbon::now(),
        ]);
    
        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('manage.coupon')->with($notification);
    }

    public function deleteCoupon($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
    
}
