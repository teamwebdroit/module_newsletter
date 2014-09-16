@extends('newsletter.layouts.master')
@section('content')

<div id="main" ng-app="newsletter"><!-- main div for app-->
    <div class="row" ng-controller="DragDropController">
        <div class="col-md-9">


            {{ Form::open(array( 'url' => 'build', 'class' => 'form-horizontal')) }}

                <div class="form-group">
                    <label for="text" class="col-sm-2 control-label">Texte</label>
                    <div class="col-sm-10">
                        <textarea id="content" name="content" class="form-control" rows="10"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Envoyer</button>
                    </div>
                </div>

            {{ Form::close() }}

            <div id="build">
                <p>Drag me to my target</p>
            </div>

        </div>
        <div class="col-md-3">
            <ul>
                <li ng-repeat="bloc in blocs">
                    <a href="#"><img src="{{ asset('images/<% bloc.images %>') }}" alt="<% bloc.title %>"></a>
                </li>
            </ul>
        </div>
    </div>

</div><!-- end main div for app-->

@stop