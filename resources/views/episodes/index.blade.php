@extends("layouts.app")

@section("title", "Episodes - PFA")

@section('content')
<div class="hero common-hero" style="background-image: url(/images/Background.png)">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1>Latest Episodes</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span> Latest Epsidoes</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="topbar-filter fw">
					<p>Found <span>{{ $count }} episodes</span> in total</p>
					<label>Sort by:</label>
					<select>
						<option value="popularity">Popularity Descending</option>
						<option value="popularity">Popularity Ascending</option>
						<option value="rating">Rating Descending</option>
						<option value="rating">Rating Ascending</option>
						<option value="date" selected>Release date Descending</option>
						<option value="date">Release date Ascending</option>
					</select>
				</div>
				<div class="mvsingle-item media-item">
                    @foreach ($episodes as $episode)
                        <div class="vd-item" style="width: 200px;">
                            <div class="vd-it">
                                <img style="height: calc(200px * 96/170);" class="vd-img" src="{{ $base }}/ethumbnails//{{ $episode["thumbnail"] }}" alt="">
                                <a class="fancybox-media hvr-grow"  href="/episodes/{{ $episode["id"] }}">
                                    <i class="ion-play"></i>
                                </a>
                            </div>
                            <div class="vd-infor">
                                <h6> <a href="#">{{ $episode["title"] }}</a></h6>
                                <p class="time">{{ $episode["duration"] }}</p>
                            </div>
                        </div>
                    @endforeach
				</div>		
				<div class="topbar-filter">
                    <label>Shows per page:</label>
                    <select id="max-items-input">
                        <option value="25" @if($max == 25) selected @endif>25 Epsiodes</option>
                        <option value="50" @if($max == 50) selected @endif>50 Epsiodes</option>
                        <option value="75" @if($max == 75) selected @endif>75 Epsiodes</option>
                        <option value="100" @if($max == 100) selected @endif>100 Epsiodes</option>
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
            window.location="?page={{ $page }}&max=" + e.target.value";
        })
    </script>
@endsection