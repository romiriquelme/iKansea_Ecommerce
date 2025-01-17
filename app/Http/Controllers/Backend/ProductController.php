<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use App\Models\MultiImg;
use Intervention\Image\Facades\Image;


use App\Models\Products as Product;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.product.add_product', compact('categories', 'subcategories'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'product_name_en' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_qty' => 'required|integer',
            'product_thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'product_tags_en' => 'required|string|max:255',
            'selling_price' => 'required|numeric',
        ]);

        try {
            // Simpan Gambar Thumbnail
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('upload/product/thumbnail/' . $name_gen);
            $save_url = 'upload/product/thumbnail/' . $name_gen;

            // Simpan Produk ke Database
            $product_id = Product::insertGetId([
                'product_name_en' => $request->product_name_en,
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_thumbnail' => $save_url,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_tags_en' => $request->product_tags_en,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price ?? null,
                'short_descp_en' => $request->short_descp_en ?? '',
                'long_descp_en' => $request->long_descp_en ?? '',
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);

            // Simpan Multiple Images jika Ada
            if ($request->hasFile('multiple_image')) {
                foreach ($request->file('multiple_image') as $img) {
                    $multi_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                    Image::make($img)->resize(917, 1000)->save('upload/product/images/' . $multi_name);
                    MultiImg::create([
                        'product_id' => $product_id,
                        'photo_name' => 'upload/product/images/' . $multi_name,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            return redirect()->route('add.product')->with([
                'message' => 'Product Added Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('add.product')->with([
                'message' => 'Something went wrong! ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function manageProduct(){
        $products = Product::latest()->get();
        return view('admin.product.product_view',compact('products'));
    }

    public function productEdit($id){
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.product_edit',compact('product','categories','subcategories','subsubcategories','multiImgs'));
    }

    public function updateDataProduct(Request $request){
        
        Product::findOrFail($id)->update([
            'product_name_en' => $request->product_name_en,
            'product_name_ind' => $request->product_name_ind,
            'product_slug_en' => $request->product_name_en,
            'product_slug_ind' => $request->product_name_ind,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ind' => $request->product_tags_ind,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ind' => $request->short_descp_ind,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ind' => $request->long_descp_ind,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.product')->with($notification);
    }

    //update multiple images
    public function updateDataImages(Request $request){
        $imgs = $request->file('multiple_img');

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            $make_img = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::read($img)->resize(917,1000)->save('upload/product/images/'.$make_img);
            $save_img = 'upload/product/images/'.$make_img;

            MultiImg::where('id',$id)->update([
                'photo_name' => $save_img,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Images Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end update multiple images

    public function updateThumbnail(Request $request, $id){
        $oldImg = $request->old_img;
        unlink($oldImg);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Images::read($image)->resize(917,1000)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        Product::findOrFail($id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );  

        return redirect()->back()->with($notification);
    }

    public function imgsDelete($id){
        $imgDel =MultiImg::findOrFail($id);
        unlink($imgDel->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Images Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function productActive($id){
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Product Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function productInactive($id){
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Product Inactive Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function productDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete(); 

        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
