@extends("layouts.app")

@section("title", $show["title"])

@section('content')
<div class="hero mv-single-hero" style="background:url({{ $base }}@if($show["thumbnail"]){{ "/thumbnails/" . $show["thumbnail"] }}@else{{ "/posters/" . $show["poster"] }}@endif)">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

			</div>
		</div>
	</div>
</div>
<div class="page-single movie-single movie_single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="movie-img sticky-sb">
					<img src="{{ $base }}/posters/{{ $show["poster"] }}" alt="">
					<div class="movie-btn">	

                        
                        @if($user && $user->hasValidSubscription())
							@if($episodesCount)
								<div class="btn-transform transform-vertical">
									<div><a href="/episodes/{{ $episodes[$episodesCount - 1]["id"] }}" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Now</a></div>
									<div><a href="/episodes/{{ $episodes[$episodesCount - 1]["id"] }}" class="item item-2 redbtn"><i class="ion-play"></i></a></div>
								</div>
							@endif
                        @else
                            <div class="btn-transform transform-vertical red">
                                <div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Trailer</a></div>
                                <div><a href="https://www.youtube.com/embed/o-0hcF97wy0" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
                            </div>
                            <div class="btn-transform transform-vertical">
                                <div><a href="/subscription" class="item item-1 yellowbtn"> <i class="ion-card"></i> Subscribe</a></div>
                                <div><a href="/subscription" class="item item-2 yellowbtn"><i class="ion-card"></i></a></div>
                            </div>
                        @endif
						
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct main-content">
					<h1 style="white-space: nowrap;" class="bd-hd">{{ $show["title"] }} <span>{{ date("Y", strtotime($show["releaseDate"])); }}</span></h1>
					<div class="social-btn">
						<a href="#" class="parent-btn @guest loginLink @endguest" @auth id="favorite-btn" @endauth>
							<div style="display: none;" class="loader">
								<span></span>
							</div>
							<i class="ion-heart @if($show["favorite"]) active @endif"></i> <span>@if($show["favorite"]) Remove From @else Add To @endif Favorite</span>
						</a>
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
					<div class="movie-rate">
						<div class="rate">
							<i class="ion-android-star"></i>
							<p><span>{{ $show["userRating"] }}</span> /10<br>
								<span class="rv">{{ $reviewsCount }} Reviews</span>
							</p>
						</div>
						<div class="rate-star">
							<p>Users Rating:  </p>
							@for ($i = 0; $i < round($show["userRating_num"]); $i++)
								<i class="ion-ios-star"></i>
							@endfor
							@for ($i = round($show["userRating_num"]); $i < 10; $i++)
								<i class="ion-ios-star-outline"></i>
							@endfor
						</div>
					</div>
					<div class="movie-tabs">
						<div class="tabs">
							<ul class="tab-links tabs-mv">
								<li class="active"><a href="#overview">Overview</a></li>
								<li><a href="#reviews"> Reviews</a></li>
								<li><a href="#cast">  Cast & Crew </a></li>
								<li><a id="AllEpisodesTrigger" href="#media">Episodes</a></li> 
								<li><a href="#moviesrelated"> Related Movies</a></li>                        
							</ul>
						    <div class="tab-content">
						        <div id="overview" class="tab active">
						            <div class="row">
										<div class="col-md-8 col-sm-12 col-xs-12">
											<p>{{ $show["description"] }}</p>
											@if($episodesCount)
												<div class="title-hd-sm">
													<h4>Episodes</h4>
													<a id="AllEpisodes" href="javascript:void;" class="time">All {{ $episodesCount }} Episodes <i class="ion-ios-arrow-right"></i></a>
												</div>
												<div class="mvsingle-item media-item">
													@foreach ($episodes->slice(0, 3) as $episode)
														<div class="vd-item" style="width: 140px;">
															<div class="vd-it">
																<img style="height: calc(140px * 96/170);" class="vd-img" src="{{ $base }}/ethumbnails//{{ $episode["thumbnail"] }}" alt="">
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
											@endif
											<div class="title-hd-sm">
												<h4>cast</h4>
												<a href="#" class="time">Full Cast & Crew  <i class="ion-ios-arrow-right"></i></a>
											</div>
											<!-- movie cast -->
											<div class="mvcast-item">
												@foreach ($latestCelebrities as $celebrity)
													<div class="cast-it">
														<div class="cast-left">
															<img class="celebrity-mini-avatar" src="{{ $base }}/cavatars/{{ $celebrity->celebrity["avatar"] }}" alt="">
															<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}</a>
														</div>
														<p>{{ $celebrity["role"] }}</p>
													</div>
												@endforeach								
											</div>
											@if($latestReview)
												<div class="title-hd-sm">
													<h4>Latest Review</h4>
													<a href="#" class="time">See All {{ $reviewsCount }} Reviews <i class="ion-ios-arrow-right"></i></a>
												</div>
												<div class="mv-user-review-item">
													<div class="user-infor">
														<img src="{{ $base }}/avatars/{{ $latestReview->user["avatar"] }}" alt="">
														<div>
															<h3>{{ $latestReview["title"] }}</h3>
															<div class="no-star">
																@for ($i = 0; $i < round($latestReview["rating"]); $i++)
																	<i class="ion-android-star"></i>
																@endfor
																@for ($i = round($latestReview["rating"]); $i < 10; $i++)
																	<i class="ion-android-star last"></i>
																@endfor
															</div>
															<p class="time">
																{{ date("j F Y h:i", strtotime($latestReview["created_at"])); }} by <a href="#"> {{ $latestReview->user["name"] }}</a>
															</p>
														</div>
													</div>
													<p>{{ $latestReview["comment"] }}</p>
												</div>
											@endif
										</div>
						            	<div class="col-md-4 col-xs-12 col-sm-12">
						            		<div class="sb-it">
						            			<h6>Director: </h6>
						            			<p>
													@foreach ($directors as $celebrity)
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}"">{{ $celebrity->celebrity["fullName"] }}@if(!$loop->last),@endif</a>
													@endforeach	
												</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Writer: </h6>
						            			<p>
													@foreach ($writers as $celebrity)
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}@if(!$loop->last),@endif</a>
													@endforeach
												</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Stars: </h6>
						            			<p>
													@foreach ($actors as $celebrity)
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}@if(!$loop->last),@endif</a>
													@endforeach
												</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Genres:</h6>
						            			<p>
                                                    @foreach ($show["genres"] as $genre)
                                                        <a href="/shows?genre={{ $genre }}">{{ $genre }}@if (!$loop->last),@endif </a>
                                                    @endforeach
                                                </p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Release Date:</h6>
						            			<p>{{ date("j F Y", strtotime($show["releaseDate"])); }}</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Run Time:</h6>
						            			<p>{{ $show["runTime"] }} min</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>MMPA Rating:</h6>
						            			<p>{{ $show["rating"] }}</p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Plot Keywords:</h6>
						            			<p class="tags">
                                                    @foreach (explode(",", $show["keywords"]) as $word)
                                                        <span class="time"><a href="#">{{ $word }}</a></span>
                                                    @endforeach
						            			</p>
						            		</div>
						            		<div class="ads">
												<img src="/images/uploads/ads1.png" alt="">
											</div>
						            	</div>
						            </div>
						        </div>
						        <div id="reviews" class="tab review">
						           <div class="row">
						            	<div class="rv-hd">
						            		<div class="div">
							            		<h3>Reviews To</h3>
						       	 				<h2>{{ $show["title"] }}</h2>
							            	</div>
							            	<a href="javascript:void;"
												@auth id="reveiwBtn" @endauth 
												class="redbtn @guest loginLink @endguest"
											>@if($userReview) Edit Review @else Write Review @endif</a>
						            	</div>
										@if($userReview)
											<div class="mv-user-review-item">
												<div class="user-infor">
													<img src="{{ $base }}/avatars/{{ $userReview->user["avatar"] }}" alt="">
													<div>
														<h3>{{ $userReview["title"] }}</h3>
														<div class="no-star">
															@for ($i = 0; $i < round($userReview["rating"]); $i++)
																<i class="ion-android-star"></i>
															@endfor
															@for ($i = round($userReview["rating"]); $i < 10; $i++)
																<i class="ion-android-star last"></i>
															@endfor
														</div>
														<p class="time">
															{{ date("j F Y h:i", strtotime($userReview["created_at"])); }} by <a href="#"> {{ $userReview->user["name"] }}</a>
														</p>
													</div>
												</div>
												<p>{{ $userReview["comment"] }}</p>
											</div>
										@endif
						            	<div class="topbar-filter">
											<p>Found <span>{{ $reviewsCount }} reviews</span> in total</p>
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
										@if($reviewsCount)
											@foreach ($reviews as $review)
												<div class="mv-user-review-item">
													<div class="user-infor">
														<img src="{{ $base }}/avatars/{{ $review->user["avatar"] }}" alt="">
														<div>
															<h3>{{ $review["title"] }}</h3>
															<div class="no-star">
																@for ($i = 0; $i < round($review["rating"]); $i++)
																	<i class="ion-android-star"></i>
																@endfor
																@for ($i = round($review["rating"]); $i < 10; $i++)
																	<i class="ion-android-star last"></i>
																@endfor
															</div>
															<p class="time">
																{{ date("j F Y h:i", strtotime($review["created_at"])); }} by <a href="#"> {{ $review->user["name"] }}</a>
															</p>
														</div>
													</div>
													<p>{{ $review["comment"] }}</p>
												</div>
											@endforeach
										@else
											<div class="no-result">There is no Reviews to show.</div>
										@endif
										<div class="topbar-filter">
											<label>Reviews per page:</label>
											<select id="max-items-input">
												<option value="5" @if($r_max == 5) selected @endif>5 Reviews</option>
												<option value="10" @if($r_max == 10) selected @endif>10 Reviews</option>
												<option value="20" @if($r_max == 20) selected @endif>20 Reviews</option>
												<option value="50" @if($r_max == 50) selected @endif>50 Reviews</option>
											</select>
											<div class="pagination2">
												@php
													$r_pages = ceil($reviewsCount / $r_max);
												@endphp
												<span>Page {{ $r_page + 1 }} of {{ $r_pages }}:</span>

												@if($r_page > 0)
													<a href="?r_page={{ $r_page - 1 }}&r_max={{ $r_max }}">
														<i class="ion-arrow-left-b"></i>
													</a>
												@endif
												

												@for($p = 1; $p <= $r_pages; $p++)
													<a @if($p - 1 == $r_page)class="active"@endif href="?r_page={{ $p - 1 }}&r_max={{ $r_max }}">{{ $p }}</a>
												@endfor

												@if($r_page < $r_pages - 1)
													<a href="?r_page={{ $r_page + 1 }}&r_max={{ $r_max }}">
														<i class="ion-arrow-right-b"></i>
													</a>
												@endif
											</div>
										</div>
						            </div>
						        </div>
						        <div id="cast" class="tab">
						        	<div class="row">
						            	<h3>Cast & Crew of</h3>
					       	 			<h2>{{ $show["title"] }}</h2>
										<!-- //== -->
					       	 			<div class="title-hd-sm">
											<h4>Credit Directors</h4>
										</div>
										<div class="mvcast-item">											
											@foreach ($directors as $celebrity)
												<div class="cast-it">
													<div class="cast-left">
														<img class="celebrity-mini-avatar" src="{{ $base }}/cavatars/{{ $celebrity->celebrity["avatar"] }}" alt="">
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}</a>
													</div>
													<p>{{ $celebrity["role"] }}</p>
												</div>
											@endforeach	
										</div>
										<!-- //== -->
										<div class="title-hd-sm">
											<h4>< Writers</h4>
										</div>
										<div class="mvcast-item">											
											@foreach ($writers as $celebrity)
												<div class="cast-it">
													<div class="cast-left">
														<img class="celebrity-mini-avatar" src="{{ $base }}/cavatars/{{ $celebrity->celebrity["avatar"] }}" alt="">
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}</a>
													</div>
													<p>{{ $celebrity["role"] }}</p>
												</div>
											@endforeach	
										</div>
										<!-- //== -->
										<div class="title-hd-sm">
											<h4>Cast</h4>
										</div>
										<div class="mvcast-item">											
											@foreach ($actors as $celebrity)
												<div class="cast-it">
													<div class="cast-left">
														<img class="celebrity-mini-avatar" src="{{ $base }}/cavatars/{{ $celebrity->celebrity["avatar"] }}" alt="">
														<a href="/celebrities/{{ $celebrity->celebrity["id"] }}">{{ $celebrity->celebrity["fullName"] }}</a>
													</div>
													<p>{{ $celebrity["role"] }}</p>
												</div>
											@endforeach	
										</div>
										<!-- //== -->
										{{-- <div class="title-hd-sm">
											<h4>Produced by</h4>
										</div>
										<div class="mvcast-item">											
											<div class="cast-it">
												<div class="cast-left">
													<h4>VA</h4>
													<a href="#">Victoria Alonso</a>
												</div>
												<p>...  executive producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>MB</h4>
													<a href="#">Mitchel Bell</a>
												</div>
												<p>...  co-producer (as Mitch Bell)</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>JC</h4>
													<a href="#">Jamie Christopher</a>
												</div>
												<p>...  associate producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>LD</h4>
													<a href="#">Louis D’Esposito</a>
												</div>
												<p>...  executive producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>JF</h4>
													<a href="#">Jon Favreau</a>
												</div>
												<p>...  executive producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>KF</h4>
													<a href="#">Kevin Feige</a>
												</div>
												<p>...  producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>AF</h4>
													<a href="#">Alan Fine</a>
												</div>
												<p>...  executive producer</p>
											</div>
											<div class="cast-it">
												<div class="cast-left">
													<h4>JF</h4>
													<a href="#">Jeffrey Ford</a>
												</div>
												<p>...  associate producer</p>
											</div>
										</div> --}}
						            </div>
					       	 	</div>
					       	 	<div id="media" class="tab">
						        	<div class="row">
						        		<div class="rv-hd">
						            		<div>
						            			<h3>Epsiodes of</h3>
					       	 					<h2>{{ $show["title"] }}</h2>
						            		</div>
						            	</div>
						            	<div class="topbar-filter">
											<p>Found <span>{{ $episodesCount }} episodes</span> in total</p>
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
										@if($episodesCount)
											<div class="mvsingle-item media-item">
												@foreach ($episodes as $episode)
													<div class="vd-item" style="width: 170px;">
														<div class="vd-it">
															<img style="height: calc(170px * 96/170);" class="vd-img" src="{{ $base }}/ethumbnails//{{ $episode["thumbnail"] }}" alt="">
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
										@else
											<div class="no-result">There is no Episodes to show</div>
										@endif
										<div class="topbar-filter">
											<label>Shows per page:</label>
											<select id="max-items-input">
												<option value="25" @if($e_max == 25) selected @endif>25 Epsiodes</option>
												<option value="50" @if($e_max == 50) selected @endif>50 Epsiodes</option>
												<option value="75" @if($e_max == 75) selected @endif>75 Epsiodes</option>
												<option value="100" @if($e_max == 100) selected @endif>100 Epsiodes</option>
											</select>
											<div class="pagination2">
												@php
													$e_pages = ceil($episodesCount / $e_max);
												@endphp
												<span>Page {{ $e_page + 1 }} of {{ $e_pages }}:</span>

												@if($e_page > 0)
													<a href="?e_page={{ $e_page - 1 }}&e_max={{ $e_max }}">
														<i class="ion-arrow-left-b"></i>
													</a>
												@endif
												

												@for($p = 1; $p <= $e_pages; $p++)
													<a @if($p - 1 == $e_page)class="active"@endif href="?e_page={{ $p - 1 }}&e_max={{ $e_max }}">{{ $p }}</a>
												@endfor

												@if($e_page < $e_pages - 1)
													<a href="?e_page={{ $e_page + 1 }}&e_max={{ $e_max }}">
														<i class="ion-arrow-right-b"></i>
													</a>
												@endif
											</div>
										</div>
						        	</div>
					       	 	</div>
					       	 	<div id="moviesrelated" class="tab">
					       	 		<div class="row">
					       	 			<h3>Related Movies To</h3>
					       	 			<h2>{{ $show["title"] }}</h2>
										<div class="topbar-filter">
											<p>Found <span>{{ $relatedCount }} movies</span> in total</p>
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
										@foreach ($relateds as $related)
											<div class="movie-item-style-2">
												<img src="{{ $base }}/posters/{{ $related->related["poster"] }}" alt="">
												<div class="mv-item-infor">
													<h6><a href="/shows/{{ $related->related["id"] }}">{{ $related->related["title"] }} <span>({{ date("Y", strtotime($related->related["releaseDate"])); }})</span></a></h6>
													<p class="rate"><i class="ion-android-star"></i><span>{{ $related->related->rating() }}</span> /10</p>
													<p class="describe">{{ $related->related["description"] }}</p>
													<p class="run-time"> Run Time: {{ $related->related["runTime"] }}’    .     <span>MMPA: {{ $related->related["rating"] }} </span>    .     <span>Release: {{ date("j F Y", strtotime($related->related["created_at"])) }}</span></p>
													<p>Director: <a href="#">Joss Whedon</a></p>
													<p>Stars: <a href="#">Robert Downey Jr.,</a> <a href="#">Chris Evans,</a> <a href="#">  Chris Hemsworth</a></p>
												</div>
											</div>
										@endforeach
										<div class="topbar-filter">
											<label>Movies per page:</label>
											<select id="max-items-input">
												<option value="5" @if($re_max == 5) selected @endif>5 Movies</option>
												<option value="10" @if($re_max == 10) selected @endif>10 Movies</option>
												<option value="20" @if($re_max == 20) selected @endif>20 Movies</option>
												<option value="50" @if($re_max == 50) selected @endif>50 Movies</option>
											</select>
											<div class="pagination2">
												@php
													$re_pages = ceil($relatedCount / $re_max);
												@endphp
												<span>Page {{ $r_page + 1 }} of {{ $re_pages }}:</span>

												@if($r_page > 0)
													<a href="?r_page={{ $r_page - 1 }}&re_max={{ $re_max }}">
														<i class="ion-arrow-left-b"></i>
													</a>
												@endif
												

												@for($p = 1; $p <= $re_pages; $p++)
													<a @if($p - 1 == $r_page)class="active"@endif href="?r_page={{ $p - 1 }}&re_max={{ $re_max }}">{{ $p }}</a>
												@endfor

												@if($r_page < $re_pages - 1)
													<a href="?r_page={{ $r_page + 1 }}&re_max={{ $re_max }}">
														<i class="ion-arrow-right-b"></i>
													</a>
												@endif
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
<div class="overlay">
	<div id="reveiwForm" class="login-content">
        <a href="#" class="close">x</a>
        <h3>Add Review</h3>

		<form method="post" action=@if($userReview) "/review/update" @else "/review" @endif>
            @csrf <!-- {{ csrf_field() }} -->
			<input type="hidden" name="show_id" value="{{ $show["id"] }}" />
            <div class="row">
				<div class="col-lg-9 col-xs-12" style="padding: 0;">
					<label for="username">
						Title:
						<input type="text" name="title"required="required" 
						@if($userReview) value="{{ $userReview["title"] }}" @endif />
					</label>
				</div>
                <div class="col-lg-3 col-xs-12" style="padding-right: 0;">
					<label for="username">
						Ratng:
						<input type="number" name="rating" min="0" max="10" required="required"
						@if($userReview) value="{{ $userReview["rating"] }}" @endif />
					</label>
				</div>
            </div>
			<div class="row">
                <label for="username">
                    Reveiw:
                    <textarea style="min-height: 150px" rows="10" name="comment" required="required"
					>@if($userReview){{ $userReview["comment"] }}@endif
					</textarea>
                </label>
            </div>
			<div class="row">
				<button type="submit">@if($userReview) Update @else Post @endif  Review</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section("scripts")
	<script>
		$(window).on('load', function() {
			$("#AllEpisodes").click(function() {
				$("#AllEpisodesTrigger").trigger( "click" );
			})
			$("#favorite-btn").on("click", function() {
				var loader = $(this).find(".loader");
				var icon = $(this).find("i");
				var text = $(this).find(" > span");
				var active = icon.hasClass("active");

				loader.show();
				icon.hide();

				$.ajax({
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					type: "POST",
					url: active ? "/unfavorite" : "/favorite",
					data: {
						show: "{{ $show["id"] }}"
					},
					success: () => {
						text.text(active ? "Add To Faovrite" : "Remove From Favorite")
						icon.toggleClass("active");
						loader.hide();
						icon.show();
					},
				});
			})

			var reviewForm = $("#reveiwForm");
			$("#reveiwBtn").on('click', function(event){
				event.preventDefault();

				reviewForm.parent().addClass("openform");
				$(document).on('click', function(e){
					var target = $(e.target);
					if ($(target).hasClass("overlay")){
						$(target).find(reviewForm).each( function(){
							$(this).removeClass("openform");
						});
						setTimeout( function(){
							$(target).removeClass("openform");
						}, 350);
					}	
				});
			});
		})

	</script>
@endsection