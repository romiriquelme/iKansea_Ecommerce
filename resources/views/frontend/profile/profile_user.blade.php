@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            @include('frontend.common.user_sidebar')
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hello </span><strong>{{ Auth::user()->name }}</strong> Edit Profile</h3>

                    <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                     @csrf   
                    <div class="form-group">
                              <label class="info-title">Name</label>
                               <input type="text" name="name" value="{{ $user->name }}" class="form-control unicase-form-control text-input" >
                         </div>

                         <div class="form-group">
                              <label class="info-title">Email</label>
                               <input type="email" name="email" value="{{ $user->email }}" class="form-control unicase-form-control text-input" >
                         </div>`

                         
                         <div class="form-group">
                              <label class="info-title">Phone</label>
                               <input type="text" name="phone" value="{{ $user->phone }}" class="form-control unicase-form-control text-input" >
                         </div>`

                         
                         <div class="form-group">
                              <label class="info-title">Photo</label>
                               <input type="file" name="profile_photo_path" class="form-control unicase-form-control text-input" >
                         </div>`
                         
                         <div class="form-group">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                         </div>`
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
