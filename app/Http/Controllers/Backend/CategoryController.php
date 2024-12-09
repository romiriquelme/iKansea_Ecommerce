<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function viewCategory(){
        $category = Category::latest()->get();
        return view('admin.category.category_view',compact('category'));
    }

    public function categoryStore(Request $request){
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ind' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Input Category English Name',
            'category_name_ind.required' => 'Input Category Ind Name',
            'category_icon.required' => 'Input Category Icon',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_ind' => $request->category_name_ind,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ind' => strtolower(str_replace(' ', '-', $request->category_name_ind)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit',compact('category'));
    }

    public function categoryUpdate(Request $request, $id){
        Category::findOrFail($id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ind' => $request->category_name_ind,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ind' => strtolower(str_replace(' ', '-', $request->category_name_ind)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function categoryDelete($id){
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
