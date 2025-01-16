<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function userView(){
        
        $users = User::latest()->get();
        return view('admin.user.user_view', compact('users'));
    }
}
