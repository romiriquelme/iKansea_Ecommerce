<?php

namespace App\Http\Controllers\Backend;

use DateTime;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function reportView(){
        return view('admin.reports.view_report');
    }

    public function reportByDate(Request $request){
        // return $request->all();
        $data = new DateTime($request->date);
        $formatDate = $data->format('d F Y');
        
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('admin.reports.report_show', compact('orders'));
    }

    public function reportByMonth(Request $request){

        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year)->latest()->get();
        return view('admin.reports.report_show', compact('orders'));
    }



    public function reportByYear(Request $request){

        $orders = Order::where('order_year', $request->year)->latest()->get();
        return view('admin.reports.report_show', compact('orders'));
    }


}
