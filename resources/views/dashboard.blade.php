@extends('frontend.main_master')
@section('content')


<div class="body-cont">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('frontend.common.user_sidebar')
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi <strong>{{ Auth::user()->name }}</strong> welcome to iKansea</span></h3>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection