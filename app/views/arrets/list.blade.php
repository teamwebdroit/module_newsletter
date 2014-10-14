@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Recueil de jurisprudence neuchâteloise</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section" ng-app="filter">

        <div class="btn-group" opt-kind>
            <button type="button" class="btn btn-default" ok-sel=".cat-5">cat5</button>
            <button type="button" class="btn btn-default" ok-sel=".cat-1">cat1</button>
            <button type="button" class="btn btn-default" ok-sel=".cat-3">cat3</button>
        </div>

        <div id="inner-content" id="isotopeContainer" isotope-container="" ng-cloak="" ng-controller="ArretController as arret">

           <post-text class="{[{ post.allcats }]}" isotope-item="" onclick="removeItem(this)" ng-repeat="post in arret.allpost track by post.id"></post-text>

        </div><!--END INNER-CONTENT-->

        <!-- Sidebar  -->
        @include('partials.filters')
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
