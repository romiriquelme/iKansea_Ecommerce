@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            @include('frontend.common.user_sidebar')
            </div>
            <div class="col-md-10 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->village->name }} {{ $order->district->name }}
                                    {{ $order->regency->name }} {{ $order->province->name }}. {{ $order->post_code }}
                                    </td>
                                    
                                </tr>
                        </tbody>
                    </table>
                </div>

                <p>
                    <strong>Notes: </strong>{{ $order->notes }}
                </p>
             
            </div>

                   
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItem as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->product->product_thumbnail)}}"
                                    style="height: 50px; width: 50px;">
                                </td>
                                <td>{{ $item->product->product_name_en }}</td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp. {{ $item->price}}</td>
                                <td>Rp. {{ $item->price * $item->qty }}</td>
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
