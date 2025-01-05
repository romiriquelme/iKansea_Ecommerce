<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\ShippingArea;

use Carbon\Carbon;


class ShippingAreaController extends Controller
{
    public function viewShipping(){
        
        // Get semua data
        $provinces = Province::all();
        $area = ShippingArea::with('province', 'regency', 'district', 'village')->latest()->get();
        return view('admin.shipping.view_shipping', compact('provinces', 'area'));
    }

    public function getRegency(Request $request){
        $id_province = $request->id_province;
        $regencies = Regency::where('province_id', $id_province)->get();
        $option = '<option>Choose City/Regency</option>';
        foreach ($regencies as $regency) {
            $option .= "<option value='$regency->id'>$regency->name</option>";
        }
        echo $option;
    }

    public function getDistrict(Request $request){
        $id_regency = $request->id_regency;
        $districts = District::where('regency_id', $id_regency)->get();
        $option = '<option>Choose District</option>';
        foreach ($districts as $district) {
            $option .= "<option value='$district->id'>$district->name</option>";
        }
        echo $option;
    }


    public function getVillage(Request $request){
        $id_district = $request->id_district;
        $villages = Village::where('district_id', $id_district)->get();
        $option = '<option>Choose Village/Sub District</option>';
        foreach ($villages as $village) {
            $option .= "<option value='$village->id'>$village->name</option>";
        }
        echo $option;
    }


    public function shippingStore(Request $request){
        $data = [
            'province_id' => $request->province,
            'regency_id' => $request->regency,
            'district_id' => $request->district,
            'village_id' => $request->village,
            'created_at' => Carbon::now(),
        ];

        ShippingArea::insert($data);
        $notification = array(
            'message' => 'Shipping Area Successfully Added',
            'alert-type' => 'success'
        );

        return redirect()->route('shipping.store')->with($notification);

    }

    public function deleteShipping($id){
        ShippingArea::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Shipping Area Successfully Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('shipping.store')->with($notification);
    }

    public function editShipping($id){
        $area = ShippingArea::findOrFail($id);
        $provinces = Province::all();

        return view('admin.shipping.edit__shipping', compact('area', 'provinces'));
    }


    public function updateShipping(Request $request, $id){

        ShippingArea::findOrFail($id)->update([
            'province_id' => $request->province,
            'regency_id' => $request->regency,
            'district_id' => $request->district,
            'village_id' => $request->village,
            'udpated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Shipping Area Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.area')->with($notification);
    }
}

