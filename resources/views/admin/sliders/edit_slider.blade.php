@extends('admin.admin_master')
@section('content')


<section class="content">
	<div class="row">


            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Slider</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                    <form method="post" action="{{ route('slider.update', $slider->id) }}">
                        @csrf
                    <div class="col-6">
									
											<input type="hidden" name="slider_img" class="form-control" value="{{ $slider->slider_img }}">
											
									<div class="form-group">
										<h5>Title</h5>
										<div class="controls">
											<input type="text" name="title" class="form-control" value="{{ $slider->title }}">
										</div>
									</div>

									<div class="form-group">
										<h5>Description </h5>
										<div class="controls">
                                        <input type="text" name="description" class="form-control"value="{{ $slider->description }}">
											
										</div>
									</div>

                                    <div class="form-group">
                                        <h5>Slider Image</h5>
                                        <div class="controls">
                                            <input type="file" name="slider_img" class="form-control">
                
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Slider">
						</div>
								</div>								
                    </form>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

       
			</div>
			<!-- /.col -->
		  </div>
</div>
<!-- /.content-wrapper -->

@endsection