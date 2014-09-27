@extends('newsletter.layouts.bail')
@section('content')


    @if(!empty($content))

        @foreach($content as $bloc)
            <?php

                echo View::make('newsletter/content/'.$bloc->type->partial)->with(array('bloc' => $bloc))->__toString();

            ?>
        @endforeach
    @endif

@stop