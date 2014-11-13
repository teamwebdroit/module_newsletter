@if( $errors->has() || Session::has('status'))

<div class="one">
    <div class="alert alert-dismissable alert-{{ Session::get('status') }}">

        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>

        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    
        @if( $errors->has())

            {{ Form::open(array('url' => 'inscription/resend')) }}
                <input type="hidden" value="{{  Input::old('email') }}" name="email" />
                @foreach( Input::old('newsletter_id') as $newsletter_id)
                    <input type="hidden" value="{{ $newsletter_id }}" name="newsletter_id[]" />
                @endforeach
                @if(count($errors) > 1)
                    <br/>
                    <button class="button small grey" type="submit">Renvoyer le lien d'activation</button>
                @endif
            {{ Form::close() }}
        @endif

        @if(Session::has('message'))
        {{ Session::get('message') }}
        @endif

    </div>
</div>

@endif