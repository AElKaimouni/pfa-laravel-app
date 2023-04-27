@extends("layouts.app")

@section("title", "Home Page - PFA")

@section('content')

<div class="slider sliderv2">
	<div class="container">
		<div class="row">
	    	<div class="slider-single-item">

				@foreach ($latest as $show)
					<div class="movie-item">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-xs-12">
								<div class="title-in">
									<div class="cate">
										@foreach ($show["genres"] as $genre)
											@php
												$color = (function($index) {
													switch($index) {
														case 0: return "blue";
														case 1: return "yell";
														case 2: return "green";
														case 3: return "orange";
													}
												})($loop->index % 4);
											@endphp
											<span class="{{ $color }}"><a href="#">{{ $genre }}</a></span>
										@endforeach
										{{-- <span class="blue"><a href="#">Sci-fi</a></span>
										<span class="yell"><a href="#">Action</a></span>
										<span class="orange"><a href="#">advanture</a></span> --}}
									</div>
									<h1><a href="shows/{{ $show["id"] }}">{{ $show["title"] }}<span>{{ date("Y", strtotime($show["releaseDate"])); }}</span></a></h1>
									<div class="social-btn">
										<a href="#" class="parent-btn"><i class="ion-play"></i> Watch Trailer</a>
										<a href="#" class="parent-btn"><i class="ion-heart"></i> Add to Favorite</a>
										<div class="hover-bnt">
											<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>share</a>
											<div class="hvr-item">
												<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
												<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
												<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
												<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
											</div>
										</div>		
									</div>
									<div class="mv-details">
										<p><i class="ion-android-star"></i><span>7.4</span> /10</p>
										<ul class="mv-infor">
											<li>  Run Time: {{ $show["runTime"] }}min’ </li>
											<li>  Rated: {{ $show["rating"] }}  </li>
											<li>  Release: {{ date("d-M-Y", strtotime($show["releaseDate"])); }}</li>
										</ul>
									</div>
									<div class="btn-transform transform-vertical">
										<div><a href="#" class="item item-1 redbtn">more detail</a></div>
										<div><a href= "#" class="item item-2 redbtn hvrbtn">more detail</a></div>
									</div>		
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="mv-img-2">
									<a href="shows/{{ $show["id"] }}"><img style="width: 300px;" src="{{ $base }}/posters/{{ $show["poster"] }}" alt=""></a>
								</div>
							</div>
						</div>	
					</div>
				@endforeach

	    	</div>
	    </div>
	</div>
</div>

<div class="movie-items  full-width">
	<div class="row">
		<div class="col-md-12">
			<div class="title-hd">
				<h2>Latest TV SHOWS</h2>
				<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
			</div>
			<div class="tabs">
				{{-- <ul class="tab-links">
					<li class="active"><a href="#tab1-h2">#Popular</a></li>
					<li><a href="javascript:;"> #Coming soon</a></li>
					<li><a href="javascript:;">  #Top rated  </a></li>
					<li><a href="javascript:;"> #Most reviewed</a></li>                        
				</ul> --}}
			    <div class="tab-content">
			        <div id="tab1-h2" class="tab active">
			            <div class="row">
			            	<div class="slick-multiItem2">
								@foreach ($latestTV as $show)
									<div class="slide-it">
										<div class="movie-item">
											<div class="mv-img">
												<img src="{{ $base }}/posters/{{ $show["poster"] }}" alt="">
											</div>
											<div class="hvr-inner">
												<a  href="shows/{{ $show["id"] }}"> Read more <i class="ion-android-arrow-dropright"></i> </a>
											</div>
											<div class="title-in">
												<h6 style="max-width: 95%;"><a href="shows/{{ $show["id"] }}">{{ $show["title"] }}</a></h6>
												<p><i class="ion-android-star"></i><span>7.4</span> /10</p>
											</div>
										</div>
									</div>
								@endforeach
			            	</div>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="title-hd">
				<h2>Latest FILMS</h2>
				<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
			</div>
			<div class="tabs">
				{{-- <ul class="tab-links">
					<li class="active"><a href="#tab1-h2">#Popular</a></li>
					<li><a href="javascript:;"> #Coming soon</a></li>
					<li><a href="javascript:;">  #Top rated  </a></li>
					<li><a href="javascript:;"> #Most reviewed</a></li>                        
				</ul> --}}
			    <div class="tab-content">
			        <div id="tab1-h2" class="tab active">
			            <div class="row">
			            	<div class="slick-multiItem2">
								@foreach ($latestFilms as $show)
									<div class="slide-it">
										<div class="movie-item">
											<div class="mv-img">
												<img src="{{ $base }}/posters/{{ $show["poster"] }}" alt="">
											</div>
											<div class="hvr-inner">
												<a  href="moviesingle.html"> Read more <i class="ion-android-arrow-dropright"></i> </a>
											</div>
											<div class="title-in">
												<h6 style="max-width: 95%;"><a href="#">{{ $show["title"] }}</a></h6>
												<p><i class="ion-android-star"></i><span>7.4</span> /10</p>
											</div>
										</div>
									</div>
								@endforeach
			            	</div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection