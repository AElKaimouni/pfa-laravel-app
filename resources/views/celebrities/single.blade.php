@extends("layouts.app")

@section("title", $celebrity["fullName"])

@section('content')
    <div class="hero hero3" style="background-image: url(/images/Background.png); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h1> movie listing - list</h1>
                    <ul class="breadcumb">
                        <li class="active"><a href="#">Home</a></li>
                        <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
    <div class="page-single movie-single cebleb-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="mv-ceb">
                        <img src="{{ $base }}/cavatars/{{ $celebrity["avatar"] }}" alt="">
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="movie-single-ct">
                        <h1 class="bd-hd">{{ $celebrity["fullName"] }}</h1>
                        <p style="text-transform: capitalize" class="ceb-single">{{ $celebrity["role"] }}</p>
                        <div class="social-link cebsingle-socail">
                            <a href="#"><i class="ion-social-facebook"></i></a>
                            <a href="#"><i class="ion-social-twitter"></i></a>
                            <a href="#"><i class="ion-social-googleplus"></i></a>
                            <a href="#"><i class="ion-social-linkedin"></i></a>
                        </div>
                        <div class="movie-tabs">
                            <div class="tabs">
                                <ul class="tab-links tabs-mv">
                                    <li class="active"><a href="#overviewceb">Overview</a></li>
                                    <li><a href="#biography"> biography</a></li>
                                    <li><a href="#filmography">filmography</a></li>                        
                                </ul>
                                <div class="tab-content">
                                    <div id="overviewceb" class="tab active">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                @php
                                                    use Illuminate\Support\Str;

                                                    $miniBio = Str::limit($celebrity["biography"], 450, ' (...)');
                                                @endphp
                                                <p>{{ $miniBio }}</p>
                                                <p class="time"><a href="#">See full bio <i class="ion-ios-arrow-right"></i></a></p>
                                                <div class="title-hd-sm">
                                                    <h4>filmography</h4>
                                                    <a href="#" class="time">Full Filmography<i class="ion-ios-arrow-right"></i></a>
                                                </div>
                                                <!-- movie cast -->
                                                <div class="mvcast-item">
                                                    @for($i = 0; $i < min(3, count($shows)); $i++)		
                                                        <div class="cast-it">
                                                            <div class="cast-left cebleb-film">
                                                                <img class="celebrity-show-mini-poster" src="{{ $base }}/posters/{{ $shows[$i]->show["poster"] }}" alt="">
                                                                <div>
                                                                    <a href="/shows/{{ $shows[$i]->show["id"] }}">{{ $shows[$i]->show["title"] }}</a>
                                                                    <p class="time">{{ $shows[$i]["role"] }}</p>
                                                                </div>
                                                                
                                                            </div>
                                                            <p>{{ date("Y", strtotime($shows[$i]->show["releaseDate"])) }}</p>
                                                        </div>
                                                    @endfor						
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12 col-sm-12">
                                                <div class="sb-it">
                                                    <h6>Fullname:  </h6>
                                                    <p><a href="#">{{ $celebrity["fullName"] }}</a></p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Date of Birth: </h6>
                                                    <p>{{ date("j F Y", strtotime($celebrity["birthDay"])); }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Country:  </h6>
                                                    <p>{{ $celebrity["country"] }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Keywords:</h6>
                                                    <p class="tags">
                                                        @foreach (explode(",", $celebrity["keywords"]) as $word)
                                                            <span class="time"><a href="#">{{ $word }}</a></span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="ads">
                                                    <img src="images/uploads/ads1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="biography" class="tab">
                                    <div class="row">
                                            <div class="rv-hd">
                                                <div>
                                                    <h3>Biography of</h3>
                                                    <h2>{{ $celebrity["fullName"] }}</h2>
                                                </div>							            						
                                            </div>
                                            <p>{{ $celebrity["biography"] }}</p>
                                        </div>
                                    </div>
                                    <div id="filmography" class="tab">
                                        <div class="row">
                                            <div class="rv-hd">
                                                <div>
                                                    <h3>Biography of</h3>
                                                    <h2>{{ $celebrity["fullName"] }}</h2>
                                                </div>
                                            
                                            </div>
                                            <div class="topbar-filter">
                                                <p>Found <span>{{ $count }} movies</span> in total</p>
                                                <label>Filter by:</label>
                                                <select>
                                                    <option value="popularity">Popularity Descending</option>
                                                    <option value="popularity">Popularity Ascending</option>
                                                    <option value="rating">Rating Descending</option>
                                                    <option value="rating">Rating Ascending</option>
                                                    <option value="date" selected>Release date Descending</option>
                                                    <option value="date">Release date Ascending</option>
                                                </select>
                                            </div>
                                            <!-- movie cast -->
                                            <div class="mvcast-item">											
                                                @foreach($shows as $show)		
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img class="celebrity-show-mini-poster" src="{{ $base }}/posters/{{ $show->show["poster"] }}" alt="">
                                                            <div>
                                                                <a href="/shows/{{ $show->show["id"] }}">{{ $show->show["title"] }}</a>
                                                                <p class="time">{{ $show["role"] }}</p>
                                                            </div>
                                                            
                                                        </div>
                                                        <p>{{ date("Y", strtotime($show->show["releaseDate"])) }}</p>
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
            </div>
        </div>
        </div>
    </div>
@endsection