@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class="active">Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="text-primary">Sign in</h4>
					<p>Welcome to your account. Please sign in below.</p>
					<div class="social-sign-in outer-top-xs">
						<a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
						<a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
					</div>
					<form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
						@csrf
						<div class="form-group">
							<label for="email" class="info-title">Email Address <span>*</span></label>
							<input type="email" id="email" name="email" class="form-control unicase-form-control text-input" required>
						</div>
						<div class="form-group">
							<label for="password" class="info-title">Password <span>*</span></label>
							<input type="password" id="password" name="password" class="form-control unicase-form-control text-input" required>
						</div>
						<div class="radio outer-xs">
							<label>
								<input type="checkbox" name="remember"> Remember me
							</label>
							<a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
						</div>
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
					</form>
				</div>
				<!-- Sign-in -->

				<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">Create a new account</h4>
	<p class="text title-tag-line">Create your new account below.</p>
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div class="form-group">
			<label for="name" class="info-title">Name <span>*</span></label>
			<input type="text" id="name" name="name" class="form-control unicase-form-control text-input" required autofocus>
		</div>
		<div class="form-group">
			<label for="email" class="info-title">Email Address <span>*</span></label>
			<input type="email" id="email" name="email" class="form-control unicase-form-control text-input" required>
		</div>
		<div class="form-group">
			<label for="password" class="info-title">Password <span>*</span></label>
			<input type="password" id="password" name="password" class="form-control unicase-form-control text-input" required>
		</div>
		<div class="form-group">
			<label for="password_confirmation" class="info-title">Confirm Password <span>*</span></label>
			<input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input" required>
		</div>
		<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Register</button>
	</form>
</div>

			</div>
		</div>
	</div>
</div>


@endsection
