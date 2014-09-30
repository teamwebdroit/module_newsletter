@extends('newsletter.layouts.master')
@section('content')

@if(!empty($content))

    @foreach($content as $bloc)
        <?php
        echo '<pre>';
        print_r($bloc->idItem);
        echo '</pre>';
        ?>
    @endforeach
@endif

@stop