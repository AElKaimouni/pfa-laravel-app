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
						<li> <span class="ion-ios-arrow-right"></span>Profile</li>
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
				@include("comps.profile-sidebar", ["active" => "profile"])
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="form-style-1 user-pro" action="">
					<form action="/profile" method="POST" class="user" enctype="multipart/form-data">
           				@csrf <!-- {{ csrf_field() }} -->
						@include("comps.messages")
						<h4>Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input name="name" value="{{ $username }}" type="text" placeholder="Username">
							</div>
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input name="email" value="{{ $email }}" type="text" placeholder="Email">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>First Name</label>
								<input name="f_name" value="{{ $f_name }}" type="text" placeholder="Frist Name">
							</div>
							<div class="col-md-6 form-it">
								<label>Last Name</label>
								<input name="l_name" value="{{ $l_name }}" type="text" placeholder="Last Name">
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
								
							</div>
							<div class="col-md-3">
								<div class="file-input">
									<input id="profile-avatar" name="avatar" type="file" placeholder="Username">
        							<div class="input-btn redbtn">Change avatar</div>
								</div>
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection