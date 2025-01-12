@extends('admin.admin_master')
@section('content')

<section class="content">
	<div class="row">

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Search by Date</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <form method="post" action="{{ route('admin.search.by.date')}}">
                            @csrf
                        <div class="col-6">
                                        <div class="form-group">
                                            <h5>Select Date<span class="text-danger">*</h5>
                                            <div class="controls">
                                                <input type="date" name="date"  class="form-control"  required>
                                            </div>
                                        </div>

                                        
                                        <div class="text-xs-right">
                                <input method="POST" type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
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


            <div class="col-4">

            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Search by Month</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <form method="post" action="{{ route('admin.search.by.month')}}">
                        @csrf
                    <div class="col-6">
                                    <div class="form-group">
                                        <h5>Select Month<span class="text-danger">*</h5>
                                        <div class="controls">
                                            <select class="form-controls" name="month" id="" required>
                                                <option disabled selected>Select Month</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <h5>Select Year<span class="text-danger">*</h5>
                                            <div class="controls">
                                                <select class="form-control" name="year" id="" required>
                                                    <option disabled selected>Select Year</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </div>
                                        </div>


                                    
                                    <div class="text-xs-right">
                            <input method="POST" type="submit" class="btn btn-rounded btn-primary mb-5" value="Select">
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


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Search by Year</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <form method="post" action="{{ route('admin.search.by.year')}}">
                            @csrf
                        <div class="col-6">
                                        <div class="form-group">
                                            <h5>Select Year<span class="text-danger">*</h5>
                                            <div class="controls">
                                                <select class="form-control" name="year" id="" required>
                                                    <option disabled selected>Select Year</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="text-xs-right">
                                <input method="POST" type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
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