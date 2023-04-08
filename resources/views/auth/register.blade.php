@extends("layouts.basic")

@section("title", "Login")

@section('content')
    @include("comps.register", ["wrapper" => false])
@endsection