@extends("admin.layouts.app")

@section("title", "Add Episode - PFA")

@section("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section("content")
<form method="POST" action=@if(!isset($episode)) "/admin/episodes/add" @else "/admin/episodes/edit/{{ $episode["id"] }}" @endif enctype="multipart/form-data">
    @csrf <!-- {{ csrf_field() }} -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Episodes</li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    Save <span class="material-symbols-outlined">save</span>
                </button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-4"> @include("admin.comps.messages") </div>
            <div class="mb-4">
                <h5 class="mb-3">Episode Title</h5>
                <input @isset($episode) value="{{ $episode["title"] }}" @endisset name="title" type="text" class="form-control" placeholder="write title here....">
            </div>
            <div class="mb-4">
                <h5 class="mb-3">Episode Description</h5>
                <textarea name="description" class="form-control" cols="4" rows="6" placeholder="write a description here..">@isset($episode){{ $episode["description"] }}@endisset</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card" style="padding-top: calc(100*96%/170)">
                <div class="card-body p-0 poster-upload">
                    <div class="text-center poster-upload-info @if(!isset($episode))active @endif" id="video-upload-info">
                        <span class="material-symbols-outlined">upload</span>
                        <h5>170 x 96</h5>
                        <h5 class="mb-3">Upload Thumbnail</h5>
                    </div>
                    <img @isset($episode) src="{{ $base }}/ethumbnails/{{ $episode["thumbnail"] }}" @endisset id="tumbnail-upload-img" />
                    <input id="tumbnail-upload" type="file" name="thumbnail" accept=".jpg, .png, .webp, image/jpeg, image/png, image/webp" multiple>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="Collection" class="form-label fw-bold">Episode Number</label>
                            <input @isset($episode) value="{{ $episode["epn"] }}" @endisset name="epn" type="number" class="form-control" id="Collection" placeholder="Episode Number">
                        </div>
                        <div class="col-12">
                            <label for="AddCategory" class="form-label fw-bold">Show</label>
                            <select id="anime-select" class="form-select" data-placeholder="Choose one thing">
                                <option></option>
                                @foreach ($shows as $show)
                                    <option value="{{$show["id"] }}" @if(isset($episode) && $episode["show_id"] === $show["id"]) selected @endif>{{ $show["title"] }}</option>
                                @endforeach
                            </select>
                            <input @if(isset($episode)) value="{{ $episode["show_id"] }}" @endif name="show_id" type="hidden" id="anime-select-input" />
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div  style="display: none" class="progress mt-3" style="height: 25px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
            </div>
            <div id="browseFile" class="card" style="padding-top: calc(100*1080%/1920)">
                <div class="card-body p-0 poster-upload video-upload">
                    <div class="text-center poster-upload-info @if(!isset($episode) || !$episode["thumbnail"])active @endif" id="video-upload-info">
                        <span class="material-symbols-outlined">upload</span>
                        <h5>1920 x 1080</h5>
                        <h5 class="mb-3">Upload Video</h5>
                    </div>
                    <button type="button" id="video-upload-btn" @if(!isset($episode) ||  !$episode["video"]) style="display: none;" @endif class="video-uplaod-clear">
                        <span class="material-symbols-outlined">
                            restart_alt
                        </span>
                    </button>
                    <video id="videoPreview" @if(!isset($episode) ||  !$episode["video"]) style="display: none;" @else src="{{ $base }}/videos/{{ $episode["video"] }}" @endif width="100%" controls>

                    </video>
                    <input type="hidden" id="video-input" name="video" />
                    {{-- <input id="video-upload" type="file" name="video" accept="video/*"> --}}
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '/video',
            query:{_token:'{{ csrf_token() }}'} ,// CSRF token
            fileType: ['mp4'],
            chunkSize: 10*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
            
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $("#videoPreview").attr('src', "/videos/" + response.filename).show().siblings("button").show().siblings("div").removeClass("active");
            $("#video-input").attr("value", response.filename)
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
    <script>
        $(function() {
            "use strict";
            var settings = {
                theme: "bootstrap-5",
                width: $( this ).data( "width" ) ? $( this ).data( "width" ) : $( this ).hasClass( "w-100" ) ? "100%" : "style",
                placeholder: $( this ).data( "placeholder" ),
                closeOnSelect: false,
                tags: true
            };

            function setupSelectInput(id) {
                $(id).select2(settings);
                $(id).on("change", function (e) {
                    $(id + "-input").attr("value", $(id).val())
                });
            }

            setupSelectInput("#anime-select");


            $("#tumbnail-upload").on("change", function() {
                const [file] = this.files;
                if (file) {
                    $(this).siblings("img").attr("src", URL.createObjectURL(file));
                    $(this).siblings("div").removeClass("active");
                } else $(this).siblings("div").addClass("active");
            })


        });
    </script>

@endsection