@extends('admin.admin_master')
@section('content')

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
					<form novalidate>
					  <div class="row">
						<div class="col-12">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Brand <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" class="form-control"> 
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
                                            <select name="category_id" class="form-control"> 
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
                                            <select name="subcategory_id" class="form-control"> 
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
                                            <select name="subsubcategory_id" class="form-control"> 
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
                                        <input type="text" name="product_name_en" class="form-control">
                                            @error('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Product Name Ind <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_name_ind" class="form-control">
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
                                        <input type="text" name="product_code" class="form-control">
                                            @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="product_qty" class="form-control">
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
                                        <input type="text" name="selling_price" class="form-control">
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
                                        <input type="text" name="discount_price" class="form-control">
                                            @error('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" name="product_thumbnail" class="form-control">
                                            @error('product_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                        <h5>Multiple Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" name="multiple_img[]" class="form-control">
                                            @error('multiple_img[]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                        <textarea id="editor1" name="long_descp_en" rows="10" cols="80">
												Long Description English.
						                </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <h5>Long Description Indonesia <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <textarea id="editor2" name="long_descp_ind" rows="10" cols="80">
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

@endsection