@extends("layouts.basic")

@section("title", "Login")

@section('content')
<div>
    <div class="login-content">
        <h3>Reset Password</h3>
        <form method="post" action="/forgot-password">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <label for="username">
                    Email:
                    <input type="email" name="email" id="username" placeholder="" required="required" />
                </label>
            </div>
            <div class="row">
                <button type="submit">Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection