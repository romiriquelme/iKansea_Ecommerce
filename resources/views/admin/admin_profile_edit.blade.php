@extend('admin.admin_master')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-full">
	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Profile</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

					<form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">

						@csrf

					  <div class="row">
						<div class="col-12">

							<div class="row">
								
								<div class="col-6">
									<div class="form-group">
										<h5>Username <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="name" class="form-control" value="{{ $editData->name }}" required="">
										</div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group">
										<h5>Email <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="email" name="email" class="form-control" value="{{ $editData->email }}" required="" data-validation-required-message="This field is required">
											</div>
										</div>
								</div>
							</div>

							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<h5>Profile Image<span class="text-danger">*</span></h5>
										<div class="controls">
											<input id="image" type="file" name="profile_photo_path" class="form-control" required=""> <div class="help-block"></div></div>
									</div>
								</div>

								<div class="col-6">
									<img id="showImage" class="rounded-circle" src="{{ (!empty($adminData->profile_photo_path))? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar" style="width:100px; height: 100px;">
								</div>

							</div>						
							


						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>


</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>





@endsection