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

            <div class="component-menu">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Component menu -->
                        <div class="panel">
                            <div class="panel-heading"><h4><i class="fa fa-cogs"></i> Bloc de contenus</h4></div>
                            <div class="panel-body">
                                <div class="component-bloc" ng-repeat="bloc in build.blocs">
                                    <buiding-blocs></buiding-blocs>
                                </div>
                            </div>
                        </div>
                        <!-- End component menu -->
                    </div>
                </div>
            </div>

            <div class="component-build">
                <!-- Build -->
                <div class="panel">
                    <div class="panel-heading">
                        <h4><i class="fa fa-pencil"></i> Contenu</h4>
                    </div>
                    <div class="panel-body">
                        <div ng-controller="DropController as dropped" id="build">
                            <image-left-text ng-if="isBloc('image-left-text')"></image-left-text>
                            <image-right-text ng-if="isBloc('image-right-text')"></image-right-text>
                            <image-text ng-if="isBloc('image-text')"></image-text>
                            <image-alone ng-if="isBloc('image')"></image-alone>
                            <text-alone ng-if="isBloc('text')"></text-alone>
                            <arret ng-if="isBloc('arret')"></arret>
                        </div>

                    </div>
                </div>
                <!-- End Build -->
            </div>

        </div><!-- end 12 col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-md-12" ng-controller="ViewController as view">

            <div class="panel">
                <div class="panel-heading">
                    <h4><i class="fa fa-envelope-o"></i> Newsletter</h4>
                </div>
                <div class="panel-body">
                    <div id="newsletterView"></div>
                </div>
            </div>

        </div>
    </div>

</div><!-- end main div for app-->


@stop