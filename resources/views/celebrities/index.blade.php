@extends("layouts.app")

@section("title", "Celebrities - PFA")

@section('content')
    <div class="hero common-hero" style="background-image: url(/images/Background.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1> Celebrities Listing</h1>
                        <ul class="breadcumb">
                            <li class="active">
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <span class="ion-ios-arrow-right"></span> Celebrities
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
                        <p>Found <span>{{ $count }} celebrities</span> in total </p>
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
                    <div class="celebrity-items">
                        @foreach ($celebrities as $celebrity)
                            <div class="ceb-item col-xs-12 col-md-6 col-lg-4">
                                <a href="/celebrities/{{ $celebrity["id"] }}">
                                    <img class="celebrity-avatar" src="{{ $base }}/cavatars/{{ $celebrity["avatar"] }}" alt="">
                                </a>
                                <div class="ceb-infor">
                                    <h2><a href="/celebrities/{{ $celebrity["id"] }}">
                                        {{ $celebrity["fullName"] }}
                                    </a></h2>
                                    <span>{{ $celebrity["role"] }}, {{ $celebrity["country"] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="topbar-filter">
                        <label>celebrities per page:</label>
                        <select id="max-items-input">
                            <option value="12" @if($max == 12) selected @endif>12 celebrities</option>
                            <option value="24" @if($max == 24) selected @endif>24 celebrities</option>
                            <option value="36" @if($max == 36) selected @endif>36 celebrities</option>
                            <option value="72" @if($max == 72) selected @endif>72 celebrities</option>
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
                            <h4 class="sb-title">Search for celebrity</h4>
                            <form class="form-style-1" type="POST" action="/celebrities">
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label>Search celebrity</label>
                                        <input value="{{ $search }}" type="search" placeholder="Search" name="search">
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>celebrity Role</label>
                                        <select name="target">
                                            <option value="">Enter to filter Types</option>
                                            <option value="actor" @if($target === "actor") selected @endif>Actor</option>
                                            <option value="writer" @if($target === "writer") selected @endif>Writer</option>
                                            <option value="director" @if($target === "director") selected @endif>Director</option>
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