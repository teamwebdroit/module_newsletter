@extends('layouts.admin')
@section('content')

    <div id="main" ng-app="newsletter"><!-- main div for app-->

        <div class="row" ng-controller="BuildController as build">
            <div class="col-md-12">

                <input id="campagne_id" value="{{ $campagne->id }}" type="hidden">

                <div class="component-menu">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Component menu -->
                            <div class="panel">
                                <div class="panel-heading"><h4><i class="fa fa-cogs"></i> Composants</h4></div>
                                <div class="panel-body">
                                    <div class="component-bloc" ng-repeat="bloc in build.blocs">
                                        <buiding-blocs></buiding-blocs>
                                    </div>
                                </div>
                            </div>
                            <!-- End component menu -->
                        </div>
                        <div class="col-md-4">
                            <a target="_blank" class="btn btn-success btn-lg" href="{{ url('admin/campagne/view/'.$campagne->id) }}">Voir la newsletter</a>
                        </div>
                    </div>
                </div>

                <div class="component-build">
                    <!-- Build -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h4><i class="fa fa-envelope-o"></i> Newsletter</h4>
                        </div>
                        <div class="panel-body">
                            <div ng-controller="DropController as dropped" id="build" data-drop="true" data-jqyoui-options jqyoui-droppable="{onDrop:'dropped'}">
                                <div class="well">
                                    <image-left-text ng-if="isBloc('image-left-text')"></image-left-text>
                                    <image-right-text ng-if="isBloc('image-right-text')"></image-right-text>
                                    <image-text ng-if="isBloc('image-text')"></image-text>
                                    <image-alone ng-if="isBloc('image')"></image-alone>
                                    <text-alone ng-if="isBloc('text')"></text-alone>
                                    <arret ng-if="isBloc('arret')"></arret>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Build -->
                </div>

            </div><!-- end 12 col -->
        </div><!-- end row -->

    </div><!-- end main div for app-->

@stop