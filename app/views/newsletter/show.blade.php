@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/campagne/'.$campagne->id.'/edit') }}" class="btn btn-info"><i class="fa fa-chevron-left"></i>  &nbsp;&Eacute;diter la campagne</a>
            </div>
        </div>

    </div>
</div>

<div id="main" ng-app="newsletter"><!-- main div for app-->

    <div class="row" ng-controller="BuildController as build">
        <div class="col-md-12">

            <input id="campagne_id" value="{{ $campagne->id }}" type="hidden">

            <div class="component-build">

                <div style="width: 600px;" ng-controller="ViewController as view">

                    <div id="bailNewsletter" ng-repeat="content in view.contents">

                        <image-left-text-edit ng-if="isTemplate('image-left-text',content.type.template)"></image-left-text-edit>
                        <image-right-text-edit ng-if="isTemplate('image-right-text',content.type.template)"></image-right-text-edit>
                        <image-text-edit ng-if="isTemplate('image-text',content.type.template)"></image-text-edit>
                        <image-alone-edit ng-if="isTemplate('image',content.type.template)"></image-alone-edit>
                        <text-alone-edit ng-if="isTemplate('text',content.type.template)"></text-alone-edit>
                        <arret-edit ng-if="isTemplate('arret',content.type.template)"></arret-edit>
                    </div>
                    <!--<div id="newsletterView" ng-include src="template"></div>-->
                </div>

                <div id="build">

                    <div class="component-menu">
                        <div class="component-bloc" ng-repeat="bloc in build.blocs">
                            <buiding-blocs></buiding-blocs>
                        </div>
                    </div>

                    <image-left-text ng-if="isBloc('image-left-text')"></image-left-text>
                    <image-right-text ng-if="isBloc('image-right-text')"></image-right-text>
                    <image-text ng-if="isBloc('image-text')"></image-text>
                    <image-alone ng-if="isBloc('image')"></image-alone>
                    <text-alone ng-if="isBloc('text')"></text-alone>
                    <arret ng-if="isBloc('arret')"></arret>

                </div>

            </div>

        </div><!-- end 12 col -->
    </div><!-- end row -->

</div><!-- end main div for app-->


@stop