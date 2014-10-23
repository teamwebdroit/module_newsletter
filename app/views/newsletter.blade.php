@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">{{ $campagne->sujet }}</h1>
    <h2 class="subtitle">{{ $campagne->auteurs }}</h2>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section">

        <div id="inner-content">

            @if(!empty($newsletter))
                @foreach($newsletter as $bloc)
                    <?php  echo View::make('content/'.$bloc->type->partial)->with(array('bloc' => $bloc))->__toString(); ?>
                @endforeach
            @endif

        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.liste')
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
