@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Jurisprudence</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section" ng-app="filtering">

        <div id="inner-content" ng-cloak ng-controller="ArretController as arret">

            <div class="one" id="spinner" ng-show="arret.loading"></div>

            <p ng-show="arret.isEmpty()">Aucun arrêts avec votre séléction</p>

            <div ng-show="arret.isSelected(post.allcats)" post-text class="{[{ post.allcats }]}"
                 ng-repeat="post in arret.pagedItems track by $index" on-finish-render></div>

            <div class="wp-pagenavi text-align-center" ng-show="!arret.isEmpty()">
                <span class="pages">Page {[{ currentPage + 1 }]} de {[{ arret.pageCount() }]}</span>
                <a ng-class="arret.prevPageDisabled()" href ng-click="arret.prevPage()">←</a>
                <a ng-class="arret.isCurrentPage(n)" ng-repeat="n in arret.range()" ng-click="arret.setPage(n)" href="#">{[{n+1}]}</a>
                <a ng-class="arret.nextPageDisabled()" href ng-click="arret.nextPage()">→</a>
            </div><!--END WP-PAGENAVI-->

        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.filters')
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
