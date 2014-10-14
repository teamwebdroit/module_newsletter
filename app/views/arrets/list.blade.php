@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Recueil de jurisprudence neuchâteloise</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section" ng-app="filtering">

        <div id="inner-content" ng-controller="ArretController as arret">
              <div id="spinner" ng-show="arret.loading"></div>
              <div ng-show="arret.isSelected(post.allcats)" post-text class="{[{ post.allcats }]}"ng-repeat="post in arret.allpost track by post.id"></div>
        </div>
        <!-- Sidebar  -->
        @include('partials.filters')
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
