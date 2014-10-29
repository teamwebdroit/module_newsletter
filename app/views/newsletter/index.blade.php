@extends('layouts.admin')
@section('content')

    <div id="main" ng-app="newsletter"><!-- main div for app-->

        <div ng-controller="BuildController as build">
            <input id="campagne_id" value="2" type="hidden">
            <div class="row">
                <div class="col-md-1" ng-repeat="bloc in build.blocs">
                    <buiding-blocs></buiding-blocs>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
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

        </div>

    </div><!-- end main div for app-->

@stop