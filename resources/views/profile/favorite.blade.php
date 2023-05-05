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
				@include("comps.profile-sidebar", ["active" => "favorite"])
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
                <div class="topbar-filter user">
                    <p>Found <span>{{ $count }} shows</span> in total </p>
                    <label>Sort by:</label>
                    <select>
                        <option value="range">-- Choose option --</option>
                        <option value="saab">-- Choose option 2--</option>
                    </select>
                </div>
                <div class="flex-wrap-movielist user-fav-list">
                    @foreach($shows as $show)
                        <div class="movie-item-style-2">
                            <img style="max-width:180px;" src="{{ $base }}/posters/{{ $show["poster"] }}" alt="">
                            <div class="mv-item-infor">
                                <h6>
                                    <a href="/shows/{{ $show["id"] }}">{{ $show["title"] }} <span>({{ date("Y", strtotime($show["releaseDate"])); }})</span>
                                    </a>
                                </h6>
                                <p class="rate">
                                    <i class="ion-android-star"></i>
                                    <span>8.1</span> /10
                                </p>
                                <p class="describe">
                                    {{ \Illuminate\Support\Str::limit($show["description"], 150, "...") }}
                                </p>
                                <p class="run-time"> Run Time: {{ $show["runTime"] }}min . <span>MMPA: {{ $show["rating"] }} </span> . <span>Release: {{ date("d-M-Y", strtotime($show["releaseDate"])); }}</span>
                                </p>
                                <p>Director: <a href="#">Joss Whedon</a>
                                </p>
                                <p>Stars: <a href="#">Robert Downey Jr.,</a>
                                    <a href="#">Chris Evans,</a>
                                    <a href="#"> Chris Hemsworth</a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="topbar-filter">
                    <label>Shows per page:</label>
                    <select id="max-items-input">
                        <option value="12" @if($max == 12) selected @endif>12 Shows</option>
                        <option value="24" @if($max == 24) selected @endif>24 Shows</option>
                        <option value="36" @if($max == 36) selected @endif>36 Shows</option>
                        <option value="72" @if($max == 72) selected @endif>72 Shows</option>
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