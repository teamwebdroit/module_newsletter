@if( $errors->has() || Session::has('status'))

<div class="one">
    <div class="alert alert-dismissable alert-{{ Session::get('status') }}">

        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach

        @if(Session::has('message'))
        {{ Session::get('message') }}
        @endif

    </div>
</div>

@endif