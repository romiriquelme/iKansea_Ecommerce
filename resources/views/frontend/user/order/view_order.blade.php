@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            @include('frontend.common.user_sidebar')
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-10 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Invoice</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>
                                    @if ($order->status == 'Pending')
                                    <span class="badge badge-pill badge-warning">{{ $order->status }}</span>
                                    @else
                                    <span class="badge badge-pill badge-success">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('order.detail', $order->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View</a>
                                    <a href="{{ route('invoice', $order->id)}}" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-download"></i>Invoice</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
             
            </div>
        </div>
    </div>
</div>



@endsection
