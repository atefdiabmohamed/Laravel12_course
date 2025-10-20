@if (session('status'))
    {{ session('status') }}
@endif

@if (session('username'))
    <p> {{ session('username') }} </p>
@endif

@if (session('email'))
    <p> {{ session('email') }} </p>
@endif

@if (session('role'))
    <p> {{ session('role') }} </p>
@endif
