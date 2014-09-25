@extends('newsletter.layouts.bail')
@section('content')


    @if(!empty($content))
        @foreach($content as $bloc)
       <?php

            //$view = View::make('content/'.$bloc->)->with($bloc);

            //echo $view;
        echo '<pre>';
            //print_r($bloc);
        echo '</pre>';

       ?>
        @endforeach
    @endif

@stop