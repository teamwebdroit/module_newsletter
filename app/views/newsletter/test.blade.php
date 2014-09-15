@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            @if(!empty($content))
                <?php
                    echo '<pre>';
                    print_r($content);
                    echo '</pre>';
                ?>
            @endif


        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>

@stop