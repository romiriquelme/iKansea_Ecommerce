<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use Carbon\Carbon;
use App\Models\MultiImg;
use Intervention\Image\Image;

use App\Models\Products as Product;

class ProductController extends Controller
{
    public function addProduct(){
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.add_product',compact('categories','subcategories', 'brands'));
    }

    public function productStore(Request $request){
        
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'product_name_en' => $request->product_name_en,
            'product_name_ind' => $request->product_name_ind,
            'product_slug_en' => $request->product_name_en,
            'product_slug_ind' => $request->product_name_ind,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_thumbnail' => $save_url,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'brand_id' => $request->brand_id,
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
            'created_at' => Carbon::now(),
        ]);

        //insert data multiple images
        $images = $request->file('multiple_image');
        foreach($images as $img){
            $make_img = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/product/images/'.$make_img);
            $save_img = 'upload/product/images/'.$make_img;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $save_img,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
