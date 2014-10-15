@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Recueil de jurisprudence neuchâteloise</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section" ng-app="filtering">

        <div id="inner-content" ng-cloak ng-controller="ArretController as arret">

            <div class="one" id="spinner" ng-show="arret.loading"></div>
            <div ng-show="arret.isSelected(post.allcats)" post-text class="{[{ post.allcats }]}"
                 ng-repeat="post in arret.pagedItems track by $index"></div>

            <div class="wp-pagenavi text-align-center">
                <a ng-class="arret.prevPageDisabled()" href ng-click="arret.prevPage()">« Prev</a>
                <a ng-class="arret.isCurrentPage(n)" ng-repeat="n in arret.range()" ng-click="arret.setPage(n)" href="#">{[{n+1}]}</a>
                <a ng-class="arret.nextPageDisabled()" href ng-click="arret.nextPage()">Next »</a>
            </div><!--END WP-PAGENAVI-->

        </div>
        <!-- Sidebar  -->
        @include('partials.filters')
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
