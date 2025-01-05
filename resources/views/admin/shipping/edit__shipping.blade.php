@extends('admin.admin_master')
@section('content')


<section class="content">
	<div class="row">


            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Shipping</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                    <form method="post" action="{{ route('shipping.update', $area->id)}}">
                        @csrf
                    <div class="col-6">

                        <div class="form-group">
                            <h5>Province<span class="text-danger">*</h5>
                                <div class="controls">
                                    <select class="form-controls" name="province" id="province" required="">
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}" {{ $province->id == $area->province_id ? 'selected' : ''}}> {{ $province->name }} </option>
                                        @endforeach
                                        
                                        
                                    </select>
                             </div>
                        </div>

                        <div class="form-group">
                            <h5>Regency<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="form-controls" name="regency" id="regency" required="">
                                    <option disabled selected>{{ $area->regency->name }}</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Districts<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="form-controls" name="district" id="district" required="">
                                    <option disabled selected>{{ $area->district->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Village<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="form-controls" name="village" id="village" required="">
                                    <option disabled selected>{{ $area->village->name }}</option>
                                </select>
                            </div>
                        </div>
									





                        <div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Shipping">
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#province').on('change', function(){
                let id_province = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.regency') }}",
                    data : {
                        id_province:id_province,
                        _token: '{{ csrf_token() }}'
                    },
                    cache : 'false',

                    success:function(response){
                        console.log('seng iki lo' + response);
                        $('#regency').html(response);
                        $('#district').html(' ');
                        $('#village').html(' ');
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })


            $('#regency').on('change', function(){
                let id_regency = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.district') }}",
                    data : {id_regency:id_regency,_token: '{{ csrf_token() }}'},
                    cache : 'false',

                    success:function(response){
                        $('#district').html(response);
                        $('#village').html(' ');
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })


            $('#district').on('change', function(){
                let id_district = $(this).val();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('get.village') }}",
                    data : {id_district:id_district,_token: '{{ csrf_token() }}'},
                    cache : 'false',

                    success:function(response){
                        $('#village').html(response);
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })
        });
    </script>

@endsection