@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">Newsletter</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section">

        <div id="inner-content">

            @if(!empty($newsletter))
                @foreach($newsletter as $bloc)
                    <?php  echo View::make('newsletter/content/'.$bloc->type->partial)->with(array('bloc' => $bloc))->__toString(); ?>
                @endforeach
            @endif

        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.liste')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
