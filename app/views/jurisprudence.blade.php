@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Jurisprudence</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section" ng-app="filtering">

        <div id="inner-content">
            <div id="filtering">
                <div class="arrets">

                    @include('newsletter.templates.analyse')

                    @if(!empty($arrets))

                        <h4 class="title-section-top"><i class="fa fa-university"></i> &nbsp;&nbsp;Jurisprudence</h4>

                        @foreach($arrets as $post)
                            @include('newsletter.templates.post')
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            <div class="fixed">
                @include('partials.filter')
            </div>
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
