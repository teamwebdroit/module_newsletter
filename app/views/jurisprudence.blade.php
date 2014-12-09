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
                    @if(!empty($arrets))
                        @foreach($arrets as $post)
                            @include('newsletter.templates.post')
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.filter')
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
