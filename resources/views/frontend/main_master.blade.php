<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">



</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->

@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong id="pname"></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-3">
				<div class="card" style="width: 18rem;">
				  <img src="" id="pimage" class="card-img-top" style="width: 100%" alt="...">
				</div>
			</div>
			<div class="col-md-6">
				<ul class="list-group">
					<li class="list-group-item">Product Price : <span id="price"> / <del id="oldprice"></del></li>
					<li class="list-group-item">Product Code : <span id="pcode"></span></li>
					<li class="list-group-item">Category : <span id="pcategory"></span></li>
					<li class="list-group-item">Stock : <span id="pstock"></span></li>
				</ul>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="quantity">Quantity</label>
					<input type="number" class="form-control" id="qty" value="1" min="1">
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
		<input type="hidden" id="product_id" value="">
        <button type="button" class="btn btn-primary" onclick="addToCart()">Add to cart</button>
      </div>
    </div>
  </div>
</div>

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset('/frontend/assets/js/jquery-1.11.1.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/echo.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/jquery.easing-1.3.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/bootstrap-slider.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/jquery.rateit.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('/frontend/assets/js/lightbox.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/bootstrap-select.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('/frontend/assets/js/scripts.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


	<script type="text/javascript">
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type', 'info') }}"
		switch(type){
			case 'info':
				toastr.info(" {{ Session::get('message') }}");
			break;

			case 'success':
				toastr.success(" {{ Session::get('message') }}");
			break;

			case 'warning':
				toastr.warning(" {{ Session::get('message') }}");
			break;

		case 'error':
				toastr.error(" {{ Session::get('message') }}");
			break;
		}
		@endif
	</script>

	<script type="text/javascript">
		$ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})

		function productView(id){
			$.ajax({
				type: 'GET',
				url: '/product/view/modal/'+id,
				dataType: 'json',
				success: function(data){
					$('#pname').text(data.product.product_name_en);
					
					$('#pcode').text(data.product.product_code);
					$('#pcategory').text(data.product.category.category_name_en);
					$('#pstock').text(data.product.product_qty);
					$('#pimage').attr('src', '/'+data.product.product_thumbnail);

					$('#product_id').val(id);
					$('#qty').val(1)
					//price
					if(data.product.discount_price == null){
						$('#price').text(data.product.selling_price);
					}else{
						$('#price').text(data.product.discount_price);
						$('$oldprice').text(data.product.selling_price);
					}
				}
			})
		}


		function addToCart(){
			let product_name = $('#pname').text();
			let id = $('#product_id').val();
			let qty = $('#qty').val();

			$.ajax({
				type: 'POST',
				dataType: 'json',
				data: {
					product_name: product_name,
					id: id,
					qty: qty
				},
				url: "/cart/data/store"+id,
				success: function(data){
					miniCart();
					$('#closeModal').click();

					const Toastr = Swal.mixin({
									toast: true,
									position: "top-end",
									icon: "success",
									showConfirmButton: false,
									timer: 3000
									});

					if($.isEmptyObject(data.error)){
						Toastr.fire({
							type: 'success',
							title: data.success
						})
					}else{
						Toastr.fire({
							type: 'error',
							title: data.error
						})
					}
				}
			})
		}
	</script>

	<script type="text/javascript">
		function miniCart(){
			$.ajax({
				type: 'GET',
				url: '/product/mini/cart',
				dataType: 'json',
				success: function(response){
					
					$('span[id="cartSubTotal"]').text(response.cartTotal);
					$('#cartQty').text(response.cartQty);

					let miniCart = "";

					$.each(response.carts, function(key, value){
						miniCart += ' <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href=""><img src="/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="">${value.name}</a></h3>
                      <div class="price">${ value.price} * ${value.qty}</div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <hr>'
					});

					$('#miniCart').html(miniCart);
				}
			})
		}

		miniCart();
		
		
		function miniCartRemove(rowId){
			$.ajax({
				type: 'GET',
				url: '/minicart/product-remove/'+rowId,
				dataType: 'json',
				success: function(data){
					miniCart()

					const Toastr = Swal.mixin({
									toast: true,
									position: "top-end",
									icon: "success",
									showConfirmButton: false,
									timer: 3000
									});

					if($.isEmptyObject(data.error)){
						Toastr.fire({
							type: 'success',
							title: data.success
						})
					}else{
						Toastr.fire({
							type: 'error',
							title: data.error
						})
					}
				}
			})
		}
		
	
	</script>
	<script>
	function addToWishlist(product_id){
		$.ajax({
			type: 'POST',
			url: '/user/add/wishlist/'+product_id,
			dataType: 'json',
			success: function(data){
				const Toastr = Swal.mixin({
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 3000
								});

				if($.isEmptyObject(data.error)){
					Toastr.fire({
						type: 'success',
						icon: "success",
						title: data.success
					})
				}else{
					Toastr.fire({
						type: 'error',
						icom: "error",
						title: data.error
					})
				}
			}
		})
	}
		
	</script>

	<script>
		function getWishlist(){
			$.ajax({
				type: 'GET',
				url: '/user/wishlist/data',
				dataType: 'json',
				success: function(response){
					let row = "";
					
					$.each(response, function(key, value){
						row += '<tr>
									<td class="col-md-2"><img src="/${value.product.product_thumbnail}" alt="imga"></td>
									<td class="col-md-7">
										<div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
										<div class="rating">
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star non-rate"></i>
											<span class="review">( 06 Reviews )</span>
										</div>
										<div class="price">
											${value.product.discount_price == null ?
												 $(value.product.selling_price) : 
												 $(value.product.discount_price) 
												 <span class="price-before-discount">
												 ${value.product.selling_price}
												 </span>
												}
										</div>
									</td>
									<td class="col-md-2">
											<button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart" id="${value.product_id}" onclick="productView(this.id)">
                                                Add To Cart
                                            </button>
									</td>
									<td class="col-md-1 close-btn">
										<button id="${value.id}" onclick="removeWishlist(this.id)" ><i class="fa fa-times"></i></button>
									</td>
								</tr>'
					})

					$('#getWishlist').html(row);
				}
			})
		}

		getWishlist();

		function removeWishlist(id){
			$.ajax({
				type: 'GET',
				url: '/user/remove/wishlist/'+id,
				dataType: 'json',
				success: function(data){
					getWishlist();

					const Toastr = Swal.mixin({
									toast: true,
									position: "top-end",
									showConfirmButton: false,
									timer: 3000
									});

					if($.isEmptyObject(data.error)){
						Toastr.fire({
							type: 'success',
							icon: "success",
							title: data.success
						})
					}else{
						Toastr.fire({
							type: 'error',
							icon: "success",
							title: data.error
						})
					}
				}
			})
		}
	</script>

	<script>
		function getMyCart(){
			$.ajax({
				type: 'GET',
				url: '/mycart/data',
				dataType: 'json',
				success: function(response){
					let row = "";
					$.each(response.carts, function(key, value){
						row += '<tr>
									<td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="width: 100%;"></td>
									<td class="col-md-7">
										<div class="product-name"><a href="#">${value.name}</a></div>
										<div class="rating">
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star rate"></i>
											<i class="fa fa-star non-rate"></i>
											<span class="review">( 06 Reviews )</span>
										</div>
										<div class="price">
											${value.price}
										</div>
									</td>
									<td class="col-md-2">
									${value.qty > 1 ?
										'<button class="btn btn-sm btn-warning" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>' :
										'<button class="btn btn-sm btn-warning" disabled="">-</button>'
									}
										<input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width: 25px; text-align: center;">

										<button class="btn btn-sm btn-success" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
									
									</td>
									<td class="col-md-2">
										${value.subtotal}
									</td>
									<td class="col-md-1 close-btn">
										<button id="${value.rowId}" onclick="removeMyCart(this.id)" ><i class="fa fa-times"></i></button>
									</td>
								</tr>'
					})

					$('#getMyCart').html(row);
				}
			})
		}

		getMyCart();

		function removeMyCart(id){
			$.ajax({
				type: 'GET',
				url: '/mycart/remove/'+id,
				dataType: 'json',
				success: function(data){
					Cart();
					miniCart();

					const Toastr = Swal.mixin({
									toast: true,
									position: "top-end",
									showConfirmButton: false,
									timer: 3000
									});

					if($.isEmptyObject(data.error)){
						Toastr.fire({
							type: 'success',
							icon: "success",
							title: data.success
						})
					}else{
						Toastr.fire({
							type: 'error',
							icon: "success",
							title: data.error
						})
					}
				}
			})
		}
		
		//cart increment

		function cartIncrement(rowId){
			$.ajax({
				type: 'GET',
				url: '/mycart/increment/'+$rowId,
				dataType: 'json',
				success: function(data){
					cart();
					miniCart();
				}
			})
		}

		//cart decrement

		function cartDecrement(rowId){
			$.ajax({
				type: 'GET',
				url: '/mycart/decrement/'+$rowId,
				dataType: 'json',
				success: function(data){
					cart();
					miniCart();
				}
			})
		}
	</script>


// Function Coupon Apply

<script>
		function applyCoupon(){
			let coupon_name = $('#coupon_name').val();
			$.ajax({
				type : 'POST',
				dataType : 'json',
				data : {coupon_name:coupon_name},
				url : "{{ url('/coupon-apply')}}",
				
				success:function(data){

					const Toastr = Swal.mixin({
									toast: true,
									position: "top-end",
									showConfirmButton: false,
									timer: 3000
									});

					if($.isEmptyObject(data.error)){
						Toastr.fire({
							type: 'success',
							icon: "success",
							title: data.success
						});
					}else{
						Toastr.fire({
							type: 'error',
							icon: "success",
							title: data.error
						});
				}
			})
		}

</script>

// End of Function Coupon Apply
</body>
</html> 