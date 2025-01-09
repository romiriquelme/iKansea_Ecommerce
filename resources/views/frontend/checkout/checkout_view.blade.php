@extends('frontend.main_master')
@section('content')

@section('title')
    My Checkout
@endsection()

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->



<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">















						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	

	<div id="collapseOne" class="panel-collapse collapse in">
		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 guest-login">
					<h4 class="checkout-subtitle"><b>Shipping Address</b></h4>



					<!-- radio-form  -->
					<form class="register-form" role="form" method="post" action="{{ route('checkout.detail')}}">
						@csrf
					
					    <div class="radio radio-checkout-unicase">  
					        <div class="form-group">
								<label class="info-title" for="exampleInputEmail1">Your Name <span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Input your Name" name="name" value="{{ Auth::user()->name}}" required>
							</div>


							<div class="form-group">
								<label class="info-title" for="email">Email<span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="email" placeholder="Input Your Email" name="email" value="{{ Auth::user()->email}}" required>
							</div>


							<div class="form-group">
								<label class="info-title" for="phone">Phone<span>*</span></label>
								<input type="number" class="form-control unicase-form-control text-input" id="phone" placeholder="Input Your Phone" name="phone" value="{{ Auth::user()->phone}}" required>
							</div>

							<div class="form-group">
								<label class="info-title" for="postcode">Post Code<span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="postcode" name="post_code" placeholder="Input Your Post Code" required>
							</div>
								
					
					</form>
				

				</div>
				

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
				<br><br>
					<div class="form-group">
						<h5><b>Province</b><span class="text-danger">*</h5>
						<div class="controls">
							<select class="form-controls" name="province_id" id="province" required="">
								<option disabled selected>Choose Province</option>
								@foreach ($provinces as $province)
								<option value="{{ $province->id }}">{{ $province->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<h5><b>Regency</b><span class="text-danger">*</span></h5>
						<div class="controls">
							<select class="form-controls" name="regency_id" id="regency" required="">
								
							</select>
						</div>
					</div>

					<div class="form-group">
						<h5><b>District</b><span class="text-danger">*</span></h5>
						<div class="controls">
							<select class="form-controls" name="district_id" id="district" required="">

							</select>
						</div>
					</div>

					<div class="form-group">
						<h5><b>Village</b><span class="text-danger">*</span></h5>
						<div class="controls">
							<select class="form-controls" name="village_id" id="village" required="">
								
							</select>
						</div>
					</div>

					<div class="form-group">
						<h5><b>Notes</b></h5>
						<div class="controls">
							<textarea class="form-control" name="notes"></textarea>
						</div>
					</div>

				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					    				


					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">

                    @foreach ($carts as $item )
                    <li>
                        <strong>Image : </strong>
                        <img src="{{ asset($item->options->image)}}" style="height: 50px; width: 50px;">
                    </li>

                    <li>
                        <strong>Quantity : </strong>
                        ( {{ $item->qty}})

                        <strong>Color : </strong>
                        ( {{ $item->options->color}})

						<strong>Size : </strong>
                        ( {{ $item->options->size}})

                    </li>
                    @endforeach

					@if(Session::has('coupon'))

						<hr>
						<strong>Subtotal : </strong>Rp. {{$total}}
						<hr>

						<strong>Coupon Name : </strong>{{session()->get('coupon')['coupon_name']}}
						({{session()->get('coupon')['coupon_discount']}} % )
						<hr>

						<strong>Coupon Discount : </strong>Rp. {{session()->get('coupon')['discount_amount']}}
						<hr>

						<strong>Grand Total : </strong>Rp. {{session()->get('coupon')['total_amount']}}
						<hr>

					@else
						<hr>
						<strong>Subtotal : </strong>Rp. {{ $total }} <hr>
						<strong>Grand Total : </strong>Rp. {{ $total }} <hr>
					@endif



					<hr>
					<button type="submit" class="btn btn-primary">Continue to Checkout</button>


					</form>
				<!-- END FORM ACTION -->
				</ul>		
			</div>
		</div>
	</div>
</div> 

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#province').on('change', function(){
                let id_province = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.regency') }}",
                    data : {
                        id_province:id_province,
                        _token: '{{ csrf_token() }}'
                    },
                    cache : 'false',

                    success:function(response){
                        console.log('seng iki lo' + response);
                        $('#regency').html(response);
                        $('#district').html(' ');
                        $('#village').html(' ');
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })


            $('#regency').on('change', function(){
                let id_regency = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.district') }}",
                    data : {id_regency:id_regency,_token: '{{ csrf_token() }}'},
                    cache : 'false',

                    success:function(response){
                        $('#district').html(response);
                        $('#village').html(' ');
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })


            $('#district').on('change', function(){
                let id_district = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.village') }}",
                    data : {id_district:id_district,_token: '{{ csrf_token() }}'},
                    cache : 'false',

                    success:function(response){
                        $('#village').html(response);
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })
        });
    </script>




@endsection()