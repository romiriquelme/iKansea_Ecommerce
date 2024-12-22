<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Image;

use App\Models\Slider;

class SliderController extends Controller
{
    public function viewSlider(){
        $Slider = Slider::latest()->get();
        return view('admin.sliders.view_slider', compact('Slider'));
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'slider_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'slider_img.required' => 'Please select an image',
        ]);

        if ($request->hasFile('slider_img')) {
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            Slider::insert([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->withErrors(['slider_img' => 'Please select an image']);
        }
    }

    public function sliderEdit($id){
        $Slider = Slider::findOrFail($id);
        return view('admin.sliders.edit_slider', compact('Slider'));
    }

    public function sliderUpdate(Request $request, $id){
       $old_img = $request->old_img;

        if ($request->file('slider_img')) {
            unlink($old_img);
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            Slider::findOrFail($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage.slider')->with($notification);
        } else {
            Slider::findOrFail($id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage.slider')->with($notification);
        }
    }

    public function sliderActive($id){
        Slider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Slider Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function sliderInactive($id){
        Slider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function sliderDelete($id){
        $img = Slider::findOrFail($id);
        unlink($img->slider_img);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
