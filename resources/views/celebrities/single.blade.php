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
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film1.jpg" alt="">
                                                            <div>
                                                                <a href="#">X-Men: Apocalypse </a>
                                                                <p class="time">Logan</p>
                                                            </div>
                                                            
                                                        </div>
                                                        <p>...  2016</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film2.jpg" alt="">
                                                            <div>
                                                                <a href="#">Eddie the Eagle </a>
                                                                <p class="time">Bronson Peary</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2015</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film3.jpg" alt="">
                                                            <div>
                                                                <a href="#">Me and Earl and the Dying Girl </a>
                                                                <p class="time">Hugh Jackman</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2015</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film4.jpg" alt="">
                                                            <div>
                                                                <a href="#">Night at the Museum 3 </a>
                                                                <p class="time">Blackbeard</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2014</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film5.jpg" alt="">
                                                            <div>
                                                                <a href="#">X-Men: Days of Future Past </a>
                                                                <p class="time">Wolverine</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2012</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film6.jpg" alt="">
                                                            <div>
                                                                <a href="#">The Wolverine </a>
                                                                <p class="time">Logan</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2011</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film7.jpg" alt="">
                                                            <div>
                                                                <a href="#">Rise of the Guardians </a>
                                                                <p class="time">Bunny</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2011</p>
                                                    </div>
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="images/uploads/film8.jpg" alt="">
                                                            <div>
                                                                <a href="#">The Prestige </a>
                                                                <p class="time">Robert Angier</p>
                                                            </div>
                                                        </div>
                                                        <p>...  2010</p>
                                                    </div>
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
                                                <p>Found <span>14 movies</span> in total</p>
                                                <label>Filter by:</label>
                                                <select>
                                                    <option value="popularity">Popularity Descending</option>
                                                    <option value="popularity">Popularity Ascending</option>
                                                    <option value="rating">Rating Descending</option>
                                                    <option value="rating">Rating Ascending</option>
                                                    <option value="date">Release date Descending</option>
                                                    <option value="date">Release date Ascending</option>
                                                </select>
                                            </div>
                                            <!-- movie cast -->
                                            <div class="mvcast-item">											
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film1.jpg" alt="">
                                                        <div>
                                                            <a href="#">X-Men: Apocalypse </a>
                                                            <p class="time">Logan</p>
                                                        </div>
                                                        
                                                    </div>
                                                    <p>...  2016</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film2.jpg" alt="">
                                                        <div>
                                                            <a href="#">Eddie the Eagle </a>
                                                            <p class="time">Bronson Peary</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2015</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film3.jpg" alt="">
                                                        <div>
                                                            <a href="#">Me and Earl and the Dying Girl </a>
                                                            <p class="time">Hugh Jackman</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2015</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film4.jpg" alt="">
                                                        <div>
                                                            <a href="#">Night at the Museum 3 </a>
                                                            <p class="time">Blackbeard</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2014</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film5.jpg" alt="">
                                                        <div>
                                                            <a href="#">X-Men: Days of Future Past </a>
                                                            <p class="time">Wolverine</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2012</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film6.jpg" alt="">
                                                        <div>
                                                            <a href="#">The Wolverine </a>
                                                            <p class="time">Logan</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2011</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film7.jpg" alt="">
                                                        <div>
                                                            <a href="#">Rise of the Guardians </a>
                                                            <p class="time">Bunny</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2011</p>
                                                </div>
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img src="images/uploads/film8.jpg" alt="">
                                                        <div>
                                                            <a href="#">The Prestige </a>
                                                            <p class="time">Robert Angier</p>
                                                        </div>
                                                    </div>
                                                    <p>...  2010</p>
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
    </div>
@endsection