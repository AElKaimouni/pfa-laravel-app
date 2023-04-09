@extends("layouts.basic")

@section("title", "Login")

@section('content')
<div>
    <div class="login-content">
        <h3>Reset Password</h3>
        <form method="post" action="/reset-password">
            @csrf <!-- {{ csrf_field() }} -->
            @if(isset($token))
                <input type="hidden" name="token" value="{{ $token }}" />
            @endif
            <div class="row">
                <label for="username">
                    Email:
                    <input type="email" name="email" id="username" placeholder="" required="required" />
                </label>
            </div>
                        <div class="row">
                <label for="password-2">
                    New Password:
                    <input type="password" name="password" id="password-2" placeholder="" required="required" />
                </label>
            </div>
            <div class="row">
                <label for="repassword-2">
                    re-type Password:
                    <input type="password" name="password_confirmation" id="repassword-2" placeholder="" required="required" />
                </label>
            </div>
            <div class="row">
                <button type="submit">Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection