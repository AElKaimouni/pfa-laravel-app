@extends("admin.layouts.app")

@section("title", "Add Show - PFA")

@php
    $country_list = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
@endphp


@section("styles")
    <link href="/plugins/input-tags/css/tagsinput.css" rel="stylesheet">
@endsection


@section("content")
<form method="POST" action=@if(!isset($celebrity)) "/admin/celebrities/add" @else "/admin/celebrities/edit/{{ $celebrity["id"] }}" @endif enctype="multipart/form-data">
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
                    <li class="breadcrumb-item active" aria-current="page">Celebrities</li>
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
            <div class="card" style="padding-top: calc(100*490%/340)">
                <div class="card-body p-0 poster-upload">
                    <div class="text-center poster-upload-info @if(!isset($celebrity))active @endif" id="poster-upload-info">
                        <span class="material-symbols-outlined">upload</span>
                        <h5>340 x 490</h5>
                        <h5 class="mb-3">Upload Avatar</h5>
                    </div>
                    <img @isset($celebrity) src="{{ $base }}/cavatars/{{ $celebrity["avatar"] }}" @endisset id="poster-upload-img" />
                    <input id="poster-upload" type="file" name="avatar" accept=".jpg, .png, .webp, image/jpeg, image/png, image/webp" multiple>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="AddCategory" class="form-label fw-bold">Role:</label>
                            <select name="role" class="form-select" id="AddCategory">
                                <option @if(isset($celebrity) && $celebrity["role"]==="actor" )selected @endif value="actor">Actor</option>
                                <option @if(isset($celebrity) && $celebrity["role"]==="writer" )selected @endif value="writer">Writer</option>
                                <option @if(isset($celebrity) && $celebrity["role"]==="director" )selected @endif value="director">Director</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="AddCategory" class="form-label fw-bold">Country:</label>
                            <select name="country" class="form-select" id="AddCategory">
                                @if(!isset($celebrity)) <option selected disabled>Choose a country</option> @endif
                                @foreach($country_list as $country)
                                    <option @if(isset($celebrity) && $celebrity["country"]===$country )selected @endif value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="Tags" class="form-label fw-bold">Birth Day:</label>
                            <input @isset($celebrity) value="{{ $celebrity["birthDay"] }}" @endisset name="birthDay" type="date" class="form-control" id="Tags" placeholder="Tags">
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4"> @include("admin.comps.messages") </div>
                    <div class="mb-4">
                        <h5 class="mb-3">Full Name</h5>
                        <input @isset($celebrity) value="{{ $celebrity["fullName"] }}" @endisset name="fullName" type="text" class="form-control" placeholder="write full name here....">
                    </div>
                    <div class="mb-4">
                        <h5 class="mb-3">Celebrity Biography</h5>
                        <textarea name="biography" class="form-control" cols="4" rows="10" placeholder="write a biography about celebrity here..">@isset($celebrity){{ $celebrity["biography"] }}@endisset</textarea>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Key Words</label>
                                <input name="keywords" type="text" class="form-control" data-role="tagsinput" @isset($celebrity) value="{{ $celebrity["keywords"] }}" @endisset>
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
    <script src="/plugins/input-tags/js/tagsinput.js"></script>
    <script>
        $(function() {
            "use strict";

            $("#poster-upload").on("change", function() {
                const [file] = this.files;
                if (file) {
                    $(this).siblings("img").attr("src", URL.createObjectURL(file));
                    $(this).siblings("div").removeClass("active");
                } else $(this).siblings("div").addClass("active");
            })
        });
    </script>

@endsection