@extends("admin.layouts.basic")

@section("title", "Login Page - PFA")

@section('content')
    <img src="/images/logo-mini.svg" class="mb-4" width="45" alt="">
    @include("admin.comps.messages")
    <h4 class="fw-bold">Forgot Password?</h4>
    <p class="mb-0">Enter your registered email to reset the password</p>

    <div class="form-body mt-4">
        <form method="post" action="/forgot-password" class="row g-3">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="col-12">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" placeholder="example@user.com">
            </div>
            <div class="col-12">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <a href="/admin/login" class="btn btn-light">Back to Login</a>
                </div>
            </div>
        </form>
    </div>
@endsection