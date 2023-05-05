@extends("layouts.app")

@section("title", "PFA - Paiment")

@section('content')
    <div class="hero common-hero" style="background-image: url(/images/Background.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Paiments</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="/">Home</a></li>
                            <li class="active"><a href="/subscription">
                                <span class="ion-ios-arrow-right"></span>Subscription</a>
                            </li>
                            <li> <span class="ion-ios-arrow-right"></span>Paiments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="form-style-1 user-pro" action="">
                        <form class="user">
                            <h4>Enter your debit card details</h4>
                            <div class="row">
                            <div class="col-sm-10">
                                <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" id="name" type="text" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label for="ccnumber">Credit Card Number</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="0000 0000 0000 0000" autocomplete="email">
                                            <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-credit-card"></i>
                                            </span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="ccmonth">Month</label>
                                        <select class="form-control" id="ccmonth">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="ccyear">Year</label>
                                        <select class="form-control" id="ccyear">
                                        <option>2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                        <option>2028</option>
                                        <option>2029</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="cvv">CVV/CVC</label>
                                        <input class="form-control" id="cvv" type="text" placeholder="123">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/subscription/pay?plan={{ $index }}" class="redbtn">
                                        Continue
                                    </a>

                                </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: -5em">
                    <div class="text-center" style="margin: 1em">
                        <a href="/subscription" class="redbtn" style="display: block">Change Plan</a>
                    </div>
                    
                    @include("comps.plan", [
                        "plan" => $plan,
                        "index" => $index,
                        "no_subscribe" => true
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection