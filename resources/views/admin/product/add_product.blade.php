@extends('admin.admin_master')
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

        <!-- Product Information -->
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product_name_en" class="form-label">Product Name (English)</label>
                    <input type="text" id="product_name_en" name="product_name_en" class="form-control" placeholder="Enter product name in English" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product_name_id" class="form-label">Product Name (Indonesia)</label>
                    <input type="text" id="product_name_id" name="product_name_id" class="form-control" placeholder="Enter product name in Indonesia" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product_code" class="form-label">Product Code</label>
                    <input type="text" id="product_code" name="product_code" class="form-control" placeholder="Enter product code" required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Product Thumbnail -->
            <div class="col-md-6">
                <label for="product-thumbnail">Product Thumbnail</label>
                <input type="file" id="product-thumbnail" name="product_thumbnail" class="form-control" required onchange="previewThumbnail(this)">
                <img id="thumbnail-preview" class="mt-2" style="max-width: 100px;">
            </div>

            <!-- Multiple Images -->
            <div class="col-md-6">
                <label for="multiple-images">Multiple Images</label>
                <input type="file" id="multiple-images" name="multiple_img[]" class="form-control" multiple required onchange="previewImages()">
                <div id="images-preview" class="mt-2"></div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category-select" class="form-label">Category</label>
                    <select id="category-select" name="category_id" class="form-select" required>
                        <option selected="" disabled="">Choose Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->category_name_en }} </option>
                            @endforeach
                    </select>
                    @error('category_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="subcategory-select" class="form-label">Subcategory</label>
                    <select id="subcategory-select" name="subcategory_id" class="form-select" required>
                        <option selected="" disabled="">Choose SubCategory</option>                                                
                    </select>
                    @error('subcategory_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="subsubcategory-select" class="form-label">Sub-Subcategory</label>
                    <select id="subsubcategory-select" name="subsubcategory_id" class="form-select" required>
                        <option selected="" disabled="">Choose SubSubCategory</option>                                                
                    </select>
                    @error('subsubcategory_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                </div>
            </div>
        </div>

        <!-- Prices and Quantity -->
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="selling_price" class="form-label">Selling Price</label>
                    <input type="number" id="selling_price" name="selling_price" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="number" id="discount_price" name="discount_price" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="product_tags_en" class="form-label">Product Tags (English)</label>
                    <input type="text" id="product_tags_en" name="product_tags_en" class="form-control" data-role="tagsinput" placeholder="Add tags">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="product_tags_id" class="form-label">Product Tags (Indonesia)</label>
                    <input type="text" id="product_tags_id" name="product_tags_id" class="form-control" data-role="tagsinput" placeholder="Add tags">
                </div>
            </div>
        </div>

        <div class="row">
    <!-- Short Description -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="short_desc_en" class="form-label">Short Description (English)</label>
            <textarea id="short_desc_en" name="short_desc_en" class="form-control" rows="3" placeholder="Enter short description in English" required></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="short_desc_id" class="form-label">Short Description (Indonesia)</label>
            <textarea id="short_desc_id" name="short_desc_id" class="form-control" rows="3" placeholder="Enter short description in Indonesian" required></textarea>
        </div>
    </div>
</div>


        <!-- Long Description -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="long_description_en" class="form-label">Long Description (English)</label>
                    <textarea id="editor1" name="long_desc_en" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="long_description_id" class="form-label">Long Description (Indonesia)</label>
                    <textarea id="editor2" name="long_desc_id" rows="10"></textarea>
                </div>
            </div>
        </div>

        <!-- Options Section -->
        <fieldset class="form-group mt-4">
            <legend class="h5">Options</legend>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hot_deals" name="hot_deals" value="1">
                        <label class="form-check-label" for="hot_deals">Hot Deals</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                        <label class="form-check-label" for="featured">Featured</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="special_offer" name="special_offer" value="1">
                        <label class="form-check-label" for="special_offer">Special Offer</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="special_deals" name="special_deals" value="1">
                        <label class="form-check-label" for="special_deals">Special Deals</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Add Product</button>
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

<!-- Scripts -->
<script>
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">'+ value.subcategory_name_en +'</option>');
                        });
                    },
                });
            }else{
                alert('Error');
            }
        });
    });

    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id){
                $.ajax({
                    url: "{{ url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">'+ value.subsubcategory_name_en +'</option>');
                        });
                    },
                });
            }else{
                alert('Error');
            }
        });
    });
</script>

<script>
// Preview Thumbnail
    function previewThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Preview Multiple Images
    function previewImages() {
        const previewDiv = $('#images-preview');
        previewDiv.empty();

        if ($('#multiple-images')[0].files) {
            Array.from($('#multiple-images')[0].files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewDiv.append(`<img src="${e.target.result}" style="max-width: 100px; margin-right: 5px;">`);
                };
                reader.readAsDataURL(file);
            });
        }
    }
</script>



<script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

@endsection