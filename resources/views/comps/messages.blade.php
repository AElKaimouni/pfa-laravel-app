@if ($errors->any())
    <div style="margin:0 display: none" class="alert alert-danger toast">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has("status"))
    <div style="display: none" class="alert alert-success toast">
        {{ Session::get("status") }}
    </div>
@endif