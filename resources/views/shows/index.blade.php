@extends("layouts.app")

@section("title", "Shows - PFA")

@section('content')
    <div class="hero common-hero" style="background-image: url(/images/Background.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1> Shows Listing</h1>
                        <ul class="breadcumb">
                            <li class="active">
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <span class="ion-ios-arrow-right"></span> Shows
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="topbar-filter">
                        <p>Found <span>{{ $count }} shows</span> in total </p>
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
                    <div class="flex-wrap-movielist">
                        
                        @foreach ($shows as $show)
                            <div class="movie-item-style-2 movie-item-style-1">
                                <div class="movie-item-img-cnt">
                                    <img src="{{ $base }}/posters/{{ $show["poster"] }}" alt="">

                                </div>
                                <div class="hvr-inner">
                                    <a href="/shows/{{ $show["id"] }}"> Read more <i class="ion-android-arrow-dropright"></i>
                                    </a>
                                </div>
                                <div style="margin-top: 10px" class="mv-item-infor">
                                    <h6>
                                        <a href="#">{{ $show["title"] }}</a>
                                    </h6>
                                    <p class="rate">
                                        <i class="ion-android-star"></i>
                                        <span>8.1</span> /10
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
                                <a href="?page={{ $page - 1 }}&max={{ $max }}&search={{ $search }}">
                                    <i class="ion-arrow-left-b"></i>
                                </a>
                            @endif
                            

                            @for($p = 1; $p <= $pages; $p++)
                                <a @if($p - 1 == $page)class="active"@endif href="?page={{ $p - 1 }}&max={{ $max }}&search={{ $search }}">{{ $p }}</a>
                            @endfor

                            @if($page < $pages - 1)
                                <a href="?page={{ $page + 1 }}&max={{ $max }}&search={{ $search }}">
                                    <i class="ion-arrow-right-b"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="searh-form">
                            <h4 class="sb-title">Search for movie</h4>
                            <form class="form-style-1" type="POST" action="/shows">
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label>Search Show</label>
                                        <input value="{{ $search }}" type="search" placeholder="Search" name="search">
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Show Type</label>
                                        <select name="target">
                                            <option value="">Enter to filter Types</option>
                                            <option value="TV SHOW" @if($target === "TV SHOW") selected @endif>TV SERIES</option>
                                            <option value="Film" @if($target === "Film") selected @endif>Movie</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Show Genre</label>
                                        <select name="genre">
                                            <option value="">Enter to filter genres</option>
                                            @foreach ($genres as $g)
                                                <option value="{{ $g }}" @if($g === $genre) selected @endif>{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 ">
                                        <input class="submit" type="submit" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ads">
                            <img src="images/uploads/ads1.png" alt="">
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
            window.location="?page={{ $page }}&max=" + e.target.value + "&search={{ $search }}";
        })
    </script>
@endsection