<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile_view', compact('adminData'));
    }


    public function adminProfileEdit(){
        $editData = Admin::find(1);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileUpdate(Request $request){
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Data Admin Berhasil Di Update!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function adminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function adminUpdatePassword(Request $request){
        $validation = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hasPassword = Admin::find(1)->password;
        if(Hash::check($request->oldpassword, $hasPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }
    }

}
