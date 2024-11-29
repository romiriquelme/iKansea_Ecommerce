@extend('admin.admin_master')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<section class="content">
	<div class="row">
		

            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Sub-SubCategory</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                    <form method="post" action=" {{ route('subsubcategory.update', $subsubcategory->id)}} ">
                        @csrf
                    <div class="col-12">
                                    <div class="form-group">
										<h5>Category<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="category_id" class="form-control">
                                            <option selected="" disabled="">-- Choose Category --</option>
                                                @foreach ($categoies as $c)
                                                <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->category_id ? 'selected' : ''}}> {{ $category->category_name_en }} </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>


                                    <div class="form-group">
										<h5>SubCategory<span class="text-danger">*</span></h5>
										<div class="controls">
											<select name="subcategory_id" class="form-control">
                                            <option selected="" disabled="">-- Choose SubCategory --</option>
                                            @foreach ($subcategoies as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $subsubcategory->subcategory_id ? 'selected' : ''}}> {{ $subcategory->subcategory_name_en }} </option>
                                            @endforeach                                               
                                            </select>
                                            @error('subcategory_id')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
                                

									<div class="form-group">
										<h5>Sub-SubCategory Name En <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="subsubcategory_name_en" class="form-control" value="{{ $subsubcategory->subsubcategory_name_en }}">
											@error('subsubcategory_name_en')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>


									<div class="form-group">
										<h5>Sub-SubCategory Name Ind <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="subsubcategory_name_ind" class="form-control" value="{{ $subsubcategory->subsubcategory_name_ind }}">
											@error('subsubcategory_name_ind')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>

                                    <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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