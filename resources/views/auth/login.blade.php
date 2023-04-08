@extends("layouts.basic")

@section("title", "Login")

@section('content')
    @include("comps.login", ["wrapper" => false])
@endsection