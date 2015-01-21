@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="title uppercase">Jurisprudence</h1>
                </div>
                <div class="col-md-4 text-right">
                    @include('partials.soutien')
                </div>
            </div>

        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">
    <div ng-app="filtering">

        <div id="inner-content" class="col-md-8 col-xs-12">
            <div id="filtering">
                <div class="arrets">

                    @include('content.analyse')

                    @if(!empty($arrets))

                        <h4 class="title-section-top"><i class="fa fa-university"></i> &nbsp;&nbsp;Jurisprudence</h4>

                        @foreach($arrets as $post)
                            @include('content.post')
                        @endforeach
                    @endif

                </div>
            </div>
        </div>

        <!-- Sidebar  -->
        <div id="sidebar" class="col-md-4 col-xs-12">
            <div class="fixed">
                @include('partials.filter')
            </div>
        </div>
        <!-- END Sidebar  -->

</div><!--END CONTENT-->

@stop
