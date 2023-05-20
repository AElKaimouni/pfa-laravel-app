@extends("layouts.app")

@section("title", "Home Page - PFA")

@section('content')
<div class="hero common-hero user-hero" style="background-image: url(/images/Background.png)">
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
				@include("comps.profile-sidebar", ["active" => "rated"])
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
                <div class="topbar-filter user">
                    <p>Found <span>{{ $count }} reviews</span> in total </p>
                    <label>Sort by:</label>
                    <select>
                        <option value="range">-- Choose option --</option>
                        <option value="saab">-- Choose option 2--</option>
                    </select>
                </div>
                <div class="flex-wrap-movielist user-fav-list">
                    @foreach($reviews as $review)
                        <div class="movie-item-style-2 userrate">
                            <img style="width:180px;" src="{{ $base }}/posters/{{ $review->show["poster"] }}" alt="">
                            <div class="mv-item-infor">
                                <h6><a href="#">{{ $review->show["title"] }} <span>({{ date("Y", strtotime($review->show["releaseDate"])); }})</span></a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span>{{ number_format($review["rating"], 1, ".", "") }}</span> /10</p>
                                <h6>{{ $review["title"] }}</h6>
                                <p class="time sm">{{ date("j F Y h:i", strtotime($review["created_at"])); }}</p>
                                <p>“{{ $review["comment"] }}”</p>		
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="topbar-filter">
                    <label>Reviews per page:</label>
                    <select id="max-items-input">
                        <option value="5" @if($max == 5) selected @endif>5 Review</option>
                        <option value="10" @if($max == 10) selected @endif>10 Review</option>
                        <option value="25" @if($max == 25) selected @endif>25 Review</option>
                        <option value="50" @if($max == 50) selected @endif>50 Review</option>
                    </select>
                    <div class="pagination2">
                        @php
                            $pages = ceil($count / $max);
                        @endphp
                        <span>Page {{ $page + 1 }} of {{ $pages }}:</span>

                        @if($page > 0)
                            <a href="?page={{ $page - 1 }}&max={{ $max }}">
                                <i class="ion-arrow-left-b"></i>
                            </a>
                        @endif
                        

                        @for($p = 1; $p <= $pages; $p++)
                            <a @if($p - 1 == $page)class="active"@endif href="?page={{ $p - 1 }}&max={{ $max }}">{{ $p }}</a>
                        @endfor

                        @if($page < $pages - 1)
                            <a href="?page={{ $page + 1 }}&max={{ $max }}">
                                <i class="ion-arrow-right-b"></i>
                            </a>
                        @endif
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection

@section("scripts")
    <script>
        $("#max-items-input").on("change", function(e) {
            window.location="?page={{ $page }}&max=" + e.target.value;
        })
    </script>
@endsection