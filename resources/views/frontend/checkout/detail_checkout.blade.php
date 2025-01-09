@extends('frontend.main_master')
@section('content')

@section('title')
    Checkout Detail
@endsection()

<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key')}}"></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout Detail</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->




<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-7">

                <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Shipping Address</h4>
                                    </div>
                                    <div class="">
                                        <strong>Name : </strong>{{$name}}
                                        <hr>
                                        <strong>Phone : </strong>{{$phone}}
                                        <hr>
                                        <strong>Address : </strong>{{$village->name}} {{$district->name}} {{$regency->name}} {{$province->name}}. {{$postCode}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
                
                
                
                
                    <div class="col-md-5">

                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Detail Order</h4>
                                    </div>

                                    @foreach ($carts as $cart)
                                    <div class="row">
                                        <div class="ol-md-4">
                                            <img src="{{ $cart->options->image }}" width="100%">
                                        </div>
                                        <div class="col-md-8">
                                            <h4 class="unicase-checkout-title">{{ $cart->name }}</h4>
                                            <hr>
                                            <p class="unicase-checkout-title">Quantity : {{ $cart->qty }} | Color : {{ $cart->options->color }} | Size : {{ $cart->options->size}}</p>
                                            <hr>
                                            <p class="unicase-checkout-title">Prixce : Rp.{{ $cart->price }}</p>

                                        </div>	
                                        <hr>
                                    </div>
                                    @endforeach


                                    <strong><h4 class="unicase-checkout-title">Grand Total : Rp.{{ $total_amount }}</h4></strong>
                                </div>
                            </div>
                        </div>


                        
					<div class="panel-group checkout-steps" id="accordion">
						
					    <!-- checkout-step-02  -->
					  	<div class="panel panel-default checkout-step-02">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
						          Notes
						        </a>
						      </h4>
						    </div>
						    <div id="collapseTwo" class="panel-collapse collapse">
						      <div class="panel-body">
						      {{ $notes }}
						      </div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->	

                          <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    
                                    <div class="">
                                        <button class="btn btn-primary" id="pay-button">Pay Now</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

					</div><!-- /.checkout-steps -->

                    </div>
<!-- checkout-progress-sidebar -->				
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->

</div><!-- /.body-content -->






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<form action="{{ route('checkout.store') }}" method="post" id="submitForm">
    @csrf
    <input type="hidden" name="json" id="js_callback">
    <input type="hidden" name="id_order" id="id_order" value="{{ $order_id }}">



</form>


<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          function sendResponseToForm(result)
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          function sendResponseToForm(result)
        },
        onError: function (result) {
          /* You may add your own implementation here */
          function sendResponseToForm(result)
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });

    function sendResponseToForm(result){
      document.getElementById('js_callback').value() = JSON.stringify(result);
      $('#submitForm').submit();
      document.getElementById('id_order').value = $(this).val();
    }
  </script>
@endsection()