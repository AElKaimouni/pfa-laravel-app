@extends("admin.layouts.app")

@section("title", "Dashboard Page - PFA")

@section("styles")
    <link href="/plugins/input-tags/css/tagsinput.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section("content")
<form method="POST" action=@if(!isset($show)) "/admin/shows/add" @else "/admin/shows/edit/{{ $show["id"] }}" @endif enctype="multipart/form-data">
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
                    <li class="breadcrumb-item active" aria-current="page">Shows</li>
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
    <div class="row">
            <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-0 poster-upload">
                    <div class="text-center poster-upload-info @if(!isset($show))active @endif" id="poster-upload-info">
                        <span class="material-symbols-outlined">upload</span>
                        <h5>360 x 521</h5>
                        <h5 class="mb-3">Upload Poster</h5>
                    </div>
                    <img @isset($show) src="/posters/{{ $show["poster"] }}" @endisset id="poster-upload-img" />
                    <input id="poster-upload" type="file" name="poster" accept=".jpg, .png, image/jpeg, image/png" multiple>
                </div>
            </div> 
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="AddCategory" class="form-label fw-bold">Type:</label>
                            <select  name="type" class="form-select" id="AddCategory">
                                <option @if(isset($show) && $show["type"] === "TV SHOW")selected @endif value="TV SHOW">TV SHOW</option>
                                <option @if(isset($show) && $show["type"] === "Film")selected @endif value="FILM">Film</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="AddCategory" class="form-label fw-bold">MMPA Rating:</label>
                            <select name="rating" class="form-select" id="AddCategory">
                                <option @if(isset($show) && $show["rating"] === "G")selected @endif value="G">G</option>
                                <option @if(isset($show) && $show["rating"] === "PG")selected @endif value="PG">PG</option>
                                <option @if(isset($show) && $show["rating"] === "PG-13")selected @endif value="PG-13">PG-13</option>
                                <option @if(isset($show) && $show["rating"] === "R")selected @endif value="R">R</option>
                                <option @if(isset($show) && $show["rating"] === "NC-17")selected @endif value="NC-17">NC-17</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="Collection" class="form-label fw-bold">Run Time (On Minutes):</label>
                            <input @isset($show) value="{{ $show["runTime"] }}" @endisset name="runTime" type="text" class="form-control" id="Collection" placeholder="Run Time">
                        </div>
                        <div class="col-12">
                            <label for="Tags" class="form-label fw-bold">Release Date:</label>
                            <input @isset($show) value="{{ $show["releaseDate"] }}" @endisset name="releaseDate" type="date" class="form-control" id="Tags" placeholder="Tags">
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        @include("admin.comps.messages")
                    </div>
                    <div class="mb-4">
                        <h5 class="mb-3">Show Title</h5>
                        <input @isset($show) value="{{ $show["title"] }}" @endisset name="title" type="text" class="form-control" placeholder="write title here....">
                    </div>
                    <div class="mb-4">
                        <h5 class="mb-3">Show Description</h5>
                        <textarea name="description" class="form-control" cols="4" rows="6" placeholder="write a description here..">@isset($show){{ $show["description"] }}@endisset</textarea>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="multiple-select-genres" class="form-label">Genres</label>
								<select class="form-select" id="multiple-select-genres" data-placeholder="Choose anything" multiple>
									@foreach ($genres as $genre)
                                        <option @if(isset($show) && in_array($genre, $show["genres"]))selected @endif>{{ $genre }}</option>
                                    @endforeach
								</select>
                                <input name="genres" type="hidden" value="@isset($show){{ join(",", $show["genres"]) }}@endisset" id="multiple-select-genres-input" />
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label">Key Words</label>
                                <input name="keywords" type="text" class="form-control" data-role="tagsinput" @isset($show) value="{{ $show["keywords"] }}" @endisset>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="multiple-select-directors" class="form-label">Directors</label>
								<select class="form-select" id="multiple-select-directors" data-placeholder="Choose anything" multiple>
									<option>Christmas Island</option>
									<option>South Sudan</option>
									<option>Jamaica</option>
									<option>Kenya</option>
									<option>French Guiana</option>
									<option>Mayotta</option>
									<option>Liechtenstein</option>
								</select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="multiple-select-writers" class="form-label">Writers</label>
								<select class="form-select" id="multiple-select-writers" data-placeholder="Choose anything" multiple>
									<option>Christmas Island</option>
									<option>South Sudan</option>
									<option>Jamaica</option>
									<option>Kenya</option>
									<option>French Guiana</option>
									<option>Mayotta</option>
									<option>Liechtenstein</option>
								</select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-12">
                                <label for="multiple-select-actors" class="form-label">Actors</label>
								<select class="form-select" id="multiple-select-actors" data-placeholder="Choose anything" multiple>
									<option>Christmas Island</option>
									<option>South Sudan</option>
									<option>Jamaica</option>
									<option>Kenya</option>
									<option>French Guiana</option>
									<option>Mayotta</option>
									<option>Liechtenstein</option>
								</select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/plugins/input-tags/js/tagsinput.js"></script>
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
                    $(id + "-input").attr("value", $(id).select2("data").map(item => item.id).join(","))
                });
            }

            setupSelectInput("#multiple-select-genres");

            $( "#multiple-select-directors" ).select2(settings);
            $( "#multiple-select-writers" ).select2(settings);
            $( "#multiple-select-actors" ).select2(settings);

            $("#poster-upload").on("change", function() {
                const [file] = this.files;
                if (file) {
                    $("#poster-upload-img").attr("src", URL.createObjectURL(file));
                    $("#poster-upload-info").removeClass("active");
                } else $("#poster-upload-info").addClass("active");
            })
        });
    </script>

@endsection