@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="padding-left: 0px;">
            @foreach($errors->all() as $error)
                <li style="list-style: none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(Session::has($key))
        <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
    @endif
@endforeach
