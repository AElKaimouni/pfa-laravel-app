@extends("layouts.app")

@section("title", $episode["title"])

@section("styles")
    <link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="hero common-hero" style="background-image: url({{ $base }}/thumbnails/{{ $episode->show["thumbnail"] }})">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 id="episodeTitle">{{ $episode["title"] }}</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="trailers full-width">
		<div class="row ipad-width">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="videos">
				 	<div class="slider-for-2 video-ft">
                        @foreach ($episodes as $ep)
                            <div>
                                <video
                                    id="my-video"
                                    class="video-js vjs-theme-fantasy"
                                    controls
                                    preload="auto"
                                    width="840"
                                    height="464"
                                    poster="{{ $base }}/ethumbnails/{{ $ep["thumbnail"] }}"
                                    data-setup="{}"
                                    data-id="{{ $ep["id"] }}"
                                >
                                    <source src="/videos/{{ $ep["video"] }}" type="video/mp4" />
                                    <p class="vjs-no-js">
                                        To view this video please enable JavaScript, and consider upgrading to a
                                        web browser that
                                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                    </p>
                                </video>
                                {{-- <video src="/videos/{{ $ep["video"] }}"  width="100%" controls></video> --}}
                            </div>
                        @endforeach
					</div>
					<div id="episodes" class="slider-nav-2 thumb-ft">
                        @foreach ($episodes as $ep)
                            <div data-id="{{ $ep["id"] }}" class="item @if($ep["id"] === $episode["id"]) activeEpisode @endif">
                                <div class="trailer-img">
                                    <img src="{{ $base }}/ethumbnails/{{ $ep["thumbnail"] }}">
                                </div>
                                <div class="trailer-infor">
                                    <h4 class="desc">{{ $ep["title"] }}</h4>
                                    <p>{{ $ep["duration"] }}</p>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
	
</div>
@endsection

@section("scripts")
    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    <script>
        $(window).on("load", function() {
            var width = $(".video-js").width();
            var height = width * (1080/1920);
            $("#episodes").css("height", height + "px");
            $(".video-js").height(height);

            $('#episodes').on('afterChange', function(event, slick, currentSlide, nextSlide){
                var item = $("#episodes .item").eq(currentSlide);
                var title = item.find("h4").text();
                var id = item.data("id");

                $("#episodeTitle").text(title);

                document.title = title;
                window.history.pushState("page", title, "/episodes/" + id);
            });

            var watched = {};

            $("video").on("play", function() {
                var id = $(this).data("id");

                if(!watched[id]) {
                    watched[id] = true;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        type: "POST",
                        url: "/episodes/history",
                        data: {
                            id: id
                        },
                        success: () => {
                            
                        },
                    });
                }
            });

            $('.activeEpisode').trigger("click")
        });
    </script>
@endsection