@extends("admin.layouts.error")

@section("title", "Error Page 403 - PFA")

@section('content')
    <h1 class="error-title text-danger mb-3">403</h1>
    <h2 class="error-sub-title text-white">Forbidden error</h2>

    <p class="error-message text-white text-uppercase">You don't have permission to access on this server</p>
    
    <div class="mt-4 d-flex align-items-center justify-content-center gap-3">
        <a href="/logout" class="btn btn-danger rounded-5 px-4">
            <i class="bi bi-house-fill me-2"></i>Logout
        </a>

        {{-- <a href="javascript:void();" class="btn btn-outline-light rounded-5 px-4">
            <i class="bi bi-arrow-left me-2"></i>Previous Page
        </a> --}}
    </div>

    <div class="mt-4">
        <p class="text-light">Copyright © 2022 | All rights reserved.</p>
    </div>
        <hr class="border-light border-2">
        <div class="list-inline contacts-social mt-4"> 
        <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0"><i class="bi bi-facebook"></i></a>
        <a href="javascript:;" class="list-inline-item bg-twitter text-white border-0"><i class="bi bi-twitter"></i></a>
        <a href="javascript:;" class="list-inline-item bg-google text-white border-0"><i class="bi bi-google"></i></a>
        <a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0"><i class="bi bi-linkedin"></i></a>
    </div>
@endsection