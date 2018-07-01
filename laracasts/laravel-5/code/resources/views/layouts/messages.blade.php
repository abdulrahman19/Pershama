@if (count($errors))
<div class="alert alert-danger alert-margin" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if ($flash = session('message'))
<div class="alert alert-success alert-margin" role="alert">
    {{ $flash }}
</div>
@endif
