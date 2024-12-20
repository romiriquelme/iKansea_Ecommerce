@extends('admin.admin_master')
@section('content')


<section class="content">
	<div class="row">
		<div class="col-12">
			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Products List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image</th>
								<th>Product Name En</th>
								<th>Price</th>
								<th>Discount</th>
								<th>Quantity</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($products as $item)
							<tr>
								<td>
                                    <img src="{{ asset($item->product_thumbnail) }}" style="width: 80px">
                                </td>
								<td>{{ $item->product_name_en }}</td>
								<td>{{ $item->selling_price }}</td>
								<td>
									@if($item->discount_price == null)
										<span class="badge badge-danger badge-pill">No Discount</span>
									@else
										@php
											$amount = $item->selling_price - $item->discount_price;
											$discount = $amount / $item->selling_price * 100;
										@endphp
										<span class="badge badge-success badge-pill">{{ round($discount) }} %</span>
									@endif
								</td>
								<td>{{ $item->product_qty }}</td>
								<td>
									@if($item->status === 1)
										<span class="badge badge-success badge-pill">Active</span>
									@else
										<span class="badge badge-danger badge-pill">Inactive</span>
									@endif
								</td>
                                <td>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></a>
									@if($item->status === 1)
										<a href="{{ route('product.inactive', $item->id) }}" class="btn btn-danger btn-sm" title="Inactive"><i class="fa fa-arrow-down"></i></a>
									@else
										<a href="{{ route('product.active', $item->id) }}" class="btn btn-primary btn-sm" title="Active"><i class="fa fa-arrow-up"></i></a>
									@endif
                                </td>
							</tr>
                            @endforeach
						</tbody>
					  </table>
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