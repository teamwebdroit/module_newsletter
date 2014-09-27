@extends('newsletter.layouts.bail')
@section('content')


    @if(!empty($content))
        @foreach($content as $bloc)
            <?php

            echo View::make('newsletter/content/'.$bloc->type->partial)->with(array('bloc' => $bloc));

           // echo '<pre>';
            //print_r($bloc->type->partial);
           // echo '</pre>';

            ?>
        @endforeach
    @endif

@stop