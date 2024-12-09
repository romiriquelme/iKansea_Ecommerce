@include('admin.admin_master')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Product</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Brand <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" class="form-control" required=""> 
                                                <option selected="" disabled="">Choose Brand</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" required=""> 
                                                <option selected="" disabled="">Choose Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Sub Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" required=""> 
                                                <option selected="" disabled="">Choose Sub Category</option>
                                            </select>
                                            @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Sub-Sub Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subsubcategory_id" class="form-control" required=""> 
                                                <option selected="" disabled="">Choose Sub-Sub Category</option>
                                            </select>
                                            @error('subsubcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Product Name En <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control" required="">
                                            @error('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Product Name Ind <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_name_ind" class="form-control" required="">
                                            @error('product_name_ind')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                <h5>Product Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_code" class="form-control" required="">
                                            @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_qty" class="form-control" required="">
                                            @error('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="selling_price" class="form-control" required="">
                                            @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="discount_price" class="form-control" required="">
                                            @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" name="product_thumbnail" class="form-control"  required="" onChange="mainThumb(this)">
                                            @error('product_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img src="" id="mainThumb">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Multiple Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" name="multiple_img[]" class="form-control" required="" multiple="" id="multiImg">
                                            @error('multiple_img[]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Short Description Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <textarea name="short_descp_ind" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <textarea id="editor1" name="long_descp_en" rows="10" cols="80" required="">
												Long Description English.
						                </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Long Description Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <textarea id="editor2" name="long_descp_ind" rows="10" cols="80" required="">
												Long Description Indonesia.
						                </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <h5>Product Tags English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" />
                                            @error('product_tags_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Product Tags Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_tags_ind" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" />
                                            @error('product_tags_ind')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>



							
						</div>

                        <hr>

					  </div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
					
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
											<label for="checkbox_2">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" name="featured" value="1">
											<label for="checkbox_3">Featured</label>
										</fieldset>
									</div>
								</div>
							</div>

                            <div class="col-md-6">
								<div class="form-group">
					
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_4" name="special_offer" value="1">
											<label for="checkbox_4">Special Offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" name="special_deals" value="1">
											<label for="checkbox_5">Special Deals</label>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
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
		<!-- /.content -->
	  </div>

<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="category_id"]').on('change',function(){
			var category_id = $(this).val();
			if(category_id) {
				$.ajax({
					url: "{{ url('/get/subcategory/') }}/"+category_id,
					type: "GET",
					dataType: "json",
					success:function(data) {
                        $('select[name="subsubcategory_id"]').html('');
						var d =$('select[name="subcategory_id"]').empty();
						$.each(data, function(key, value){
							$('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.subcategory_name_en+'</option>');
						});
					},
				});
			}else{
				alert('danger');
			}
		});

        $('select[name="subcategory_id"]').on('change',function(){
			var subcategory_id = $(this).val();
			if(subcategory_id) {
				$.ajax({
					url: "{{ url('/get/subsubcategory/') }}/"+subcategory_id,
					type: "GET",
					dataType: "json",
					success:function(data) {
						var d =$('select[name="subsubcategory_id"]').empty();
						$.each(data, function(key, value){
							$('select[name="subsubcategory_id"]').append('<option value="'+value.id+'">'+value.subsubcategory_name_en+'</option>');
						});
					},
				});
			}else{
				alert('danger');
			}
		});
	});
</script>

<script type="text/javascript">
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#multiImg').on('change',function(){
           if (window.File && window.FileReader && window.FileList && window.Blob) {
               var data = $(this)[0].files;
               $.each(data,function(index,file){
                   if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){
                       var fileReader = new FileReader();
                       fileReader.onload = function(file) {
                        return function(e) {
                            var img = $('<img/>').addClass('mt-3 mr-2').attr('src',e.target.result).width(80).height(80);
                            $('#preview_img').append(img);
                        };
                       }(file);
                       fileReader.readAsDataURL(file);
                   }
               });
           }else{
               alert('Your browser does not support File API');
           }
        });
    });
</script>

@endsection