<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function viewSubCategory(){
        $categoies = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('admin.category.subcategory_view',compact('subcategory', 'categoies'));
    }


    public function subCategoryStore(Request $request){
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_ind' => 'required',
            'category_id' => 'required',
        ],[
            'subcategory_name_en.required' => 'SubCategory English Name is Required',
            'subcategory_name_ind.required' => 'SubCategory Ind Name is Required',
            'category_id.required' => 'Choose Category',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ind' => $request->subcategory_name_ind,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_ind' => strtolower(str_replace(' ', '-', $request->subcategory_name_ind)),
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function subCategoryEdit($id) {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function subCategoryUpdate(Request $request, $id){
        SubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ind' => $request->subcategory_name_ind,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_ind' => strtolower(str_replace(' ', '-', $request->subcategory_name_ind)),
        ]);

        $notification = array(
            'message' => 'SubCategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }



    public function subCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }


    ## Method subsubcategory

    public function subSubCategoryview(){
        $categoies = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('admin.category.sub_subcategory_view',compact('subsubcategory', 'categoies'));
    }


    public function getSubcategoryAjax($category_id){
        $subcategory =SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategory);
    }

    public function getSubSubcategoryAjax($subcategory_id){
        $subsubcategory =SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcategory);
    }


    public function subSubcategoryStore(Request $request){
        $request->validate([
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_ind' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ],[
            'subsubcategory_name_en.required' => 'Sub-SubCategory English Name is Required',
            'subsubcategory_name_ind.required' => 'Sub-SubCategory Ind Name is Required',
            'category_id.required' => 'Choose Category',
            'subcategory_id.required' => 'Choose SubCategory',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ind' => $request->subsubcategory_name_ind,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ind' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_ind)),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function subSubCategoryEdit($id){
        $categoies = Category::orderBy('category_name_en','ASC')->get();
        $subcategoies = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('admin.category.sub_subcategory_edit',compact('subsubcategory', 'categoies', 'subcategoies'));
    }


    public function subSubcategoryUpdate(Request $request, $id){
        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ind' => $request->subsubcategory_name_ind,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ind' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_ind)),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function subSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

}
