@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group list-group-flush" >
            @foreach ($errors->all() as $error)
                <li class="list-group-item" style="background: none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif