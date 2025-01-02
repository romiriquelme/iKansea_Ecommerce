<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whislist;
use Auth;

class WishlistController extends Controller
{
    public function viewWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishlist(){
        $whislists = Whislist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($whislists);
    }

    public function removeWishlist($id){
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully removed from your wishlist']);
    }
}
