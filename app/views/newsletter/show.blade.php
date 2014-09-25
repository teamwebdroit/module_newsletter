@extends('newsletter.layouts.bail')
@section('content')


    @if(!empty($content))
        @foreach($content as $bloc)
            <?php

            echo View::make('newsletter/content/'.$bloc->type->partial)
                ->with(array('content' => 'content here', 'titre' => 'titre', 'image' => 'images.jpg'));

            echo '<pre>';
            //print_r($bloc->type->partial);
            echo '</pre>';

            ?>
        @endforeach
    @endif

@stop