@extends('admin.admin_master')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<section class="content">
	<div class="row">
	<div class="col-8">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Category List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="categoryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category Icon</th>
                            <th>Category (English)</th>
                            <th>Category (Indonesian)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $item)
                            <tr>
                                <td><i class="{{ $item->category_icon }}"></i></td>
                                <td>{{ $item->category_name_en }}</td>
                                <td>{{ $item->category_name_ind }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('category.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Tambahkan Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $category->links() }}
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

            <div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                    <form method="post" action="{{ route('category.store')}}">
                        @csrf
                    <div class="col-6">
									<div class="form-group">
										<h5>Category Name En <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_en" class="form-control">
											@error('category_name_en')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>

									<div class="form-group">
										<h5>Category Name Ind <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="category_name_ind" class="form-control">
											@error('category_name_ind')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>

									<div class="form-group">
										<h5>Category Icon <span class="text-danger">*</span></h5>
										<div class="controls">
                                        <input type="text" name="category_icon" class="form-control">
											@error('category_icon')
											<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
									</div>
                                    <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="AddCategory">
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

<!-- Tambahkan Script DataTables -->

<script>
   $(document).ready(function() {
            $('#categoryTable').DataTable({
                paging: true,
                searching: true,
                info: true,
                lengthChange: true,
                ordering: true
            });
        });

</script>

@endsection