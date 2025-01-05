<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Products;
use App\Models\MultiImg;


class IndexController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->limit(3)->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $products = Products::where('status',1)->OrderBy('id','DESC')->limit(6)->get();
        $featured = Products::where('featured',1)->OrderBy('id','DESC')->limit(6)->get();
        $hotDeals = Products::where('hot_deals',1)->OrderBY('id','DESC')->limit(3)->get();
        $specialOffer = Products::where('special_offer',1)->OrderBy('id','DESC')->limit(3)->get();
        $specialDeals = Products::where('special_deals',1)->OrderBy('id','DESC')->limit(3)->get();

        $skip_category_0 = Category::skip(0)->first();
            if ($skip_category_0) {
                $skip_product_0 = Products::where('status',1)->where('category_id',$skip_category_0->id)->OrderBy('id','DESC')->get();
            } else {
                $skip_product_0 = []; // or some other default value
            }

        return view('frontend.index',compact('categories','sliders', 'products', 'featured', 'hotDeals', 'specialOffer', 'specialDeals', 'skip_category_0', 'skip_product_0'));
    }

    public function detail($id,$slug){
        $products = Products::findOrFail($id);
        $multiImg = MultiImg::where('product_id',$id)->get();

        $relatedProducts = Products::where('category_id',$products->category_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

        $hotDeals = Products::where('hot_deals',1)->OrderBY('id','DESC')->limit(3)->get();
        return view('frontend.product.detail_product',compact('products', 'multiImg', 'relatedProducts', 'hotDeals'));
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('index');
    }

    public function userProfileEdit(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.profile_user',compact('user'));
    }

    public function userProfileUpdate(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Data User Berhasil Di Update!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile.edit')->with($notification);

    }

    public function changePassword() {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.change_password', compact('user'));
    }

    public function userUpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }

    // get data product by ajax
    public function getProductModal($id){
        $product = Products::with('category')->findOrFail($id);
        return response()->json(array(
            'product' => $product  
        ));
    }

}
