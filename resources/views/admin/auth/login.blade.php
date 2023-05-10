@extends("admin.layouts.basic")

@section("title", "Login Page - PFA")

@section('content')
<div class="text-center">
    <img src="/images/logo-blue.svg" class="mb-4" height="90" alt="">
    @include("admin.comps.messages")
    <h4 class="fw-bold">Admin Login</h4>
    <p class="mb-0">Enter your credentials to login your account</p>
</div>

    <div class="form-body mt-4">
    <form method="post" action="/login" class="row g-3">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="col-12">
            <label for="inputEmailAddress" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmailAddress" placeholder="jhon@example.com">
        </div>
        <div class="col-12">
            <label for="inputChoosePassword" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input name="password" type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password"> 
        <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label name="remember" class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
            </div>
        </div>
        <div class="col-md-6 text-end">	<a href="/admin/forgot-password">Forgot Password ?</a>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bi-eye-slash-fill");
            $('#show_hide_password i').removeClass("bi-eye-fill");
          } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password i').addClass("bi-eye-fill");
          }
        });
      });
    </script>
@endsection