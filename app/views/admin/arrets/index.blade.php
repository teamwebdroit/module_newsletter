@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-top: -50px;margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/arret/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-edit"></i> &nbsp;Arrêts</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="arrets">
                        <thead>
                        <tr>
                            <th class="col-sm-2">Action</th>
                            <th class="col-sm-2">Référence</th>
                            <th class="col-sm-2">Date de publication</th>
                            <th class="col-sm-6">Résumé</th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(!empty($arrets))
                            @foreach($arrets as $arret)
                                <tr>
                                    <td><a class="btn btn-sky btn-sm" href="{{ url('admin/arret/'.$arret->id) }}">éditer</a></td>
                                    <td><strong>{{ $arret->reference }}</strong></td>
                                    <td>{{ $arret->pub_date->formatLocalized('%d %B %Y') }}</td>
                                    <td>{{ $arret->abstract }}</td>
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