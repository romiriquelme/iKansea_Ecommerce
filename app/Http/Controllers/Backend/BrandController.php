<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Image;

class BrandController extends Controller
{
    public function viewBrand(){
        $brands = Brand::latest()->get();
        return view('admin.brands.brand_view', compact('brands'));
    }

    public function brandStore(Request $request){
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_ind' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_ind.required' => 'Input Brand Ind Name',
            'brand_image.required' => 'Input Brand Image',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ind' => $request->brand_name_ind,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function brandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brands.brand_edit', compact('brands'));
    }

    public function brandUpdate(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            unlink($old_img);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
    
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ind' => $request->brand_name_ind,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
                'brand_image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.brand')->with($notification);
        }else{
    
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ind' => $request->brand_name_ind,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
            ]);
    
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function brandDelete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
