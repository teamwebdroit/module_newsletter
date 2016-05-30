@extends('layouts.admin')
@section('content')

<?php $custom = new \Custom; ?>

    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-edit"></i> &nbsp;Derniers arrêts</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-2">Référence</th>
                                <th class="col-sm-2">Date de publication</th>
                                <th class="col-sm-6">Résumé</th>
                            </tr>
                            </thead>
                            <tbody class="selects">
                            <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                            @if(!empty($arrets))
                                @foreach($arrets as $arret)
                                    <tr>
                                        <td><a class="btn btn-sky btn-sm" href="{{ url('admin/arret/'.$arret->id) }}">&Eacute;diter</a></td>
                                        <td><strong>{{ $arret->reference }}</strong></td>
                                        <td>{{ $arret->pub_date->formatLocalized('%d %B %Y') }}</td>
                                        <td>{{ $custom->limit_words($arret->abstract, 10) }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4><i class="fa fa-tasks"></i> &nbsp;Derniers abonnés</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-sm-2">Action</th>
                                <th class="col-sm-2">Status</th>
                                <th class="col-sm-2">Email</th>
                                <th class="col-sm-3">Abonnements</th>
                            </tr>
                            </thead>
                            <tbody class="selects">

                            @if(!empty($abonnes))
                            @foreach($abonnes as $abonne)
                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/abonne/'.$abonne->id.'/edit') }}">&Eacute;diter</a></td>
                                <td>
                                    @if( $abonne->activated_at )
                                        <span class="label label-success">Confirmé</span>
                                    @else
                                        <span class="label label-default">Email non confirmé</span>
                                    @endif
                                </td>
                                <td>{{ $abonne->email }}</td>
                                <td>
                                    @if( !$abonne->subscription->isEmpty() )
                                    <?php
                                    $abos = $abonne->subscription->lists('titre');
                                    echo implode(',',$abos);
                                    ?>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop