<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('Backend/images/favicon.ico') }}">

    <title>Admin Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('Backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('Backend/css/skin_color.css') }}">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

	@include('admin.body.header')
	
	
	@include('admin.body.sidebar')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		@yield('content')

	</div>
	<!-- /.content-wrapper -->
	
	@include('admin.body.footer')
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->
	<script src="{{ asset('Backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>	
	<script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
	<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
	<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
	
	<!-- iKansea Admin App -->
	<script src="{{ asset('Backend/js/template.js') }}"></script>
	<script src="{{ asset('Backend/js/pages/dashboard.js') }}"></script>


	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click', '#delete', function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				Swal.fire({
				title: "Are you sure?",
				text: "Delete this data?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
				}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
					title: "Deleted!",
					text: "Your file has been deleted.",
					icon: "success"
					});
				}
				});
				
			})
		})
	</script>
	
</body>
</html>
