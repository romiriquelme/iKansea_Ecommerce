<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
     public function ind (){
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'ind');
        return redirect()->back();
    }

    public function en(){
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'en');
        return redirect()->back();
    }
}
