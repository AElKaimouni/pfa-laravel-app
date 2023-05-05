@extends("layouts.app")

@section("title", "PFA - Subscription")

@section('content')
    <div class="hero common-hero" style="background-image: url(/images/Background.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Subscriptions</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="/">Home</a></li>
                            <li> <span class="ion-ios-arrow-right"></span>Subscriptions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pricing-table">
        <div class="container">

            
            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-md-4 col-sm-6">
                        @include("comps.plan", [
                            "plan" => $plan,
                            "index" => $loop -> index
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection