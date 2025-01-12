@extends('admin.admin_master')
@section('content')


<section class="content">
	<div class="row">
		<div class="col-12">
			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Data Users</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Photo</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($users as $user)
							<tr>
								<td>
                                    <img src="{{ (!empty($adminData->profile_photo_path))? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" style="width: 50px;
                                    height: 50px;">
                                    
                                </td>

                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @if ($user->userOnline())
                                        <span class="badge badge-pill badge-success">Online</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">{{Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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