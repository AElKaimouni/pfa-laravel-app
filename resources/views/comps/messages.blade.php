@if ($errors->any())
    <div style="margin:0" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif