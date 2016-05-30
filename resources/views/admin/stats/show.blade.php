@extends('layouts.admin')
@section('content')

<?php  $charts = new \Charts; ?>

<div class="row">
    <div class="col-md-12">
        <div class="options" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/campagne') }}" class="btn btn-default"><i class="fa fa-list"></i>  &nbsp;&nbsp;Retour aux campagnes</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4><i class="fa fa-asterisk"></i> &nbsp;Statistiques de la campagne </h4>
            </div>
            <div class="panel-body">

                <h3>Campagne : {{ $campagne->sujet }}</h3>
                <?php setlocale(LC_ALL, 'fr_FR'); ?>
                <p><strong>Envoyé le {{ $campagne->updated_at->formatLocalized('%d %B %Y') }}</strong></p>

                <div class="row margeUpDown"><!-- start row -->
                    <div class="col-md-2">
                        <a href="#" class="info-tiles tiles-midnightblue">
                            <div class="tiles-heading"><div class="pull-left">Envoyés</div></div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-location-arrow"></i></div>
                                <div class="pull-right"><span>{{ $statistiques['total'] }}</span></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="info-tiles tiles-success">
                            <div class="tiles-heading"><div class="pull-left">Ouverts</div></div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-check"></i></div>
                                <div class="pull-right"><span>{{ $statistiques['opened'] }}%</span></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="info-tiles tiles-info">
                            <div class="tiles-heading"><div class="pull-left">Cliqués</div></div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-link"></i></div>
                                <div class="pull-right"><span>{{ $statistiques['clicked'] }}%</span></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="info-tiles tiles-orange">
                            <div class="tiles-heading"><div class="pull-left">Refusés</div></div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-minus-circle"></i></div>
                                <div class="pull-right"><span>{{ $statistiques['bounced'] }}%</span></div>
                            </div>
                        </a>
                    </div>
                </div><!-- end row -->

                <h3>Statistiques des liens cliqués</h3>

                <div class="row"><!-- start row -->
                    <div class="col-md-8">
                        <ul class="list-group">
                            @if(!empty($clickStats))
                                @foreach($clickStats as $url => $click)
                                <li class="list-group-item">
                                    <span class="badge badge-primary">{{ count($click) }}</span>{{ $url }}
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div><!-- end row -->


            </div>

            </div>
        </div>

    </div>
</div>

@stop