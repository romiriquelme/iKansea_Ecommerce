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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv+CaMfSyFzQ2LJcHqG2eVhj28sbzMvkvpOmf3gzZFlFCkOQ9XyYF7hvInJ" crossorigin="anonymous">


	<style>
		/* Navbar menggunakan Flexbox untuk tata letak */
		.navbar-static-top {
			display: flex;
			justify-content: space-between; /* Memisahkan bagian kiri dan kanan */
			align-items: center; /* Menjaga elemen berada di tengah secara vertikal */
			padding: 0 15px;
		}

		/* Bagian Kiri (Menu) */
		.nav {
			display: flex;
			gap: 15px; /* Jarak antar ikon */
		}

		/* Bagian Kanan (Search dan Profile) */
		.navbar-custom-menu {
			display: flex;
			justify-content: flex-end; /* Memastikan bagian kanan berada di pojok kanan */
			align-items: center; /* Menjaga elemen tetap sejajar secara vertikal */
			gap: 15px; /* Menambahkan jarak antar elemen */
		}

		/* Menghapus bullet point dan margin/padding dari navbar */
		.navbar-nav > li {
			list-style: none;
			margin: 0;
			padding: 0;
		}

		/* Menata search bar */
		.search-bar {
			display: flex;
			justify-content: center;
			max-width: 250px;
		}

		.search-bar input {
			width: 100%;
			padding: 5px 10px;
			border-radius: 20px;
			border: 1px solid #ddd;
		}

		/* Responsif untuk layar kecil */
		@media (max-width: 768px) {
			.navbar-static-top {
				flex-direction: column;
				align-items: flex-start;
			}

			.navbar-custom-menu {
				justify-content: flex-start;
			}
		}

		/* Menghilangkan bullet point di navbar */
		.nav, .navbar-nav {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		.nav > li {
			list-style: none;
		}

</style>


     
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
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0e3Dskw4zI9JymuO3Fc3Yrcmf3t0z5lZ8A3KmzZ07r5Z9F2D" crossorigin="anonymous"></script>


</body>
</html>
