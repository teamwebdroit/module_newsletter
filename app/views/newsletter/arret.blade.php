@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            <ul>
            <?php

                    echo '<pre>';
                    print_r($arret);
                    echo '</pre>';

            ?>
            </ul>

        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>

@stop