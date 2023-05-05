@extends("layouts.app")

@section("title", "Home Page - PFA")

@section('content')
<div class="hero user-hero common-hero" style="background-image: url(/images/Background.png)">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1>{{ $f_name }} {{ $l_name }}’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="/">Home</a></li>
						<li class="active"><a href="/profile">Profile</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Change Password</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				@include("comps.profile-sidebar", ["active" => "password"])
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="form-style-1 user-pro" action="">
					<form action="/profile/password" method="post" class="password">
						@csrf <!-- {{ csrf_field() }} -->
						@include("comps.messages")
						<h4>Change password</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Old Password</label>
								<input name="old_password" type="password" placeholder="**********">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input name="new_password" type="password" placeholder="***************">
							</div>
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input name="new_password_confirmation" type="password" placeholder="*************** ">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="change">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection