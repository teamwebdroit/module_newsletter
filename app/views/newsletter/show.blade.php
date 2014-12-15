@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="options" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/campagne') }}" class="btn btn-default"><i class="fa fa-list"></i>  &nbsp;&nbsp;Retour aux campagnes</a>
                <a href="{{ url('admin/campagne/'.$infos->id.'/edit') }}" class="btn btn-sky"><i class="fa fa-pencil"></i>  &nbsp;&Eacute;diter la campagne</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {{ Form::open(array('url' => array('admin/send/test') , 'class' => 'form-inline')) }}
            <div class="form-group">
                <input required name="email" value="" type="email" class="form-control">
                <input name="id" value="{{ $infos->id }}" type="hidden">
            </div>
            <button type="submit" class="btn btn-brown"><i class="fa fa-question-circle"></i>  &nbsp;&nbsp;Envoyer un test</button>
        {{ Form::close() }}
    </div>
</div>

<div id="main" ng-app="newsletter"><!-- main div for app-->

    <div class="row" ng-controller="BuildController as build">
        <div class="col-md-12">

            <input id="campagne_id" value="{{ $infos->id }}" type="hidden">

            <div class="component-build">
                <div id="bailNewsletter" class="onBuild">
                    <!-- Logos -->
                    @include('newsletter.send.logos')
                    <!-- Header -->
                    @include('newsletter.send.header')
                    <div id="viewBuild" ng-controller="ViewController as view">
                        <div id="sortable">

                            @if(!empty($campagne))
                                @foreach($campagne as $camp)
                                    <div id="bloc_rang_{{$camp->idItem}}">
                                        <?php echo View::make('newsletter/templates/edit/'.$camp->type->partial)->with(array('bloc' => $camp)); ?>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <div id="build">

                    <image-left-text ng-if="isBloc('image-left-text')"></image-left-text>
                    <image-right-text ng-if="isBloc('image-right-text')"></image-right-text>
                    <image-text ng-if="isBloc('image-text')"></image-text>
                    <image-alone ng-if="isBloc('image')"></image-alone>
                    <text-alone ng-if="isBloc('text')"></text-alone>
                    <arret ng-if="isBloc('arret')"></arret>

                    <div class="component-menu">
                        <h5>Composants</h5>
                        <div class="component-bloc">
                            <building-blocs ng-repeat="bloc in build.blocs"></building-blocs>
                        </div>
                    </div>

                </div>

            </div>

        </div><!-- end 12 col -->
    </div><!-- end row -->

</div><!-- end main div for app-->


@stop