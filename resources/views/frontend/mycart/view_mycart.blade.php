@extends('frontend.main_master')
@section('content')

@section('title')
    My Cart
@endsection()

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>My Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="my-shopping-cart">
			<div class="row">
				<div class="shoping-cart-table">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-product-name-info">Image</th>
                    <th class="cart-product-name-info">Product Name</th>
                    <th class="cart-product-name-info">Quantity</th>
                    <th class="cart-product-name-info">Total</th>
                    <th class="cart-product-name-info">Remove</th>
				</tr>
			</thead>
			<tbody id="getMyCart">

			</tbody>
		</table>
	</div>
</div>			

</div><!-- /.row -->
		</div><!-- /.sigin-in-->
</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection