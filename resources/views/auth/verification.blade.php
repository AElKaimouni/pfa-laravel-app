@extends("layouts.app")

@section("title", "Email Verification")

@section('content')
    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Email Verification</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="/">Home</a></li>
                            <li class="active"><a href="/profile">
                                <span class="ion-ios-arrow-right"></span>Profile</a>
                            </li>
                            <li> <span class="ion-ios-arrow-right"></span>Email Verification</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="email-verification">
        <div class="container">
            <h2>Check Your Email For Verification Message</h2>
            <span>if you didnt recieve any message you can resend</span>
            <a class="redbtn" href="/profile/verify">Resend verification email</a>
        </div>
    </div>
@endsection