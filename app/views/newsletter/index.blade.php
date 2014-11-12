@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-6">
        <h3>Liste des campagnes </h3>
    </div>
    <div class="col-md-6">
        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/campagne/create') }}" class="btn btn-green"><i class="fa fa-plus"></i> &nbsp;Nouvelle campagne</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="campagnes">
                        <thead>
                            <tr>
                                <th class="col-sm-2">Action</th>
                                <th class="col-sm-2">Sujet</th>
                                <th class="col-sm-2">Auteurs</th>
                                <th class="col-sm-1">Status</th>
                                <th class="col-sm-1">Création</th>
                                <th class="col-sm-2">Mise à jour le</th>
                                <th class="col-sm-1"></th>
                            </tr>
                        </thead>
                        <tbody class="selects">

                            @if(!empty($campagnes))
                                @foreach($campagnes as $campagne)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                           <a class="btn btn-sky btn-sm" href="{{ url('admin/campagne/'.$campagne->id.'/edit') }}">&Eacute;diter</a>
                                           <a class="btn btn-inverse btn-sm" href="{{ url('admin/campagne/'.$campagne->id) }}">Composer</a>
                                        </div>
                                    </td>
                                    <td><strong>{{ $campagne->sujet }}</strong></td>
                                    <td>{{ $campagne->auteurs }}</td>
                                    <td>{{ $campagne->status }}</td>
                                    <td>{{ $campagne->created_at->formatLocalized('%d %B %Y') }}</td>
                                    <td>{{ $campagne->updated_at->formatLocalized('%d %B %Y') }}</td>
                                    <td class="text-right">
                                        {{ Form::open(array('route' => array('admin.campagne.destroy', $campagne->id), 'method' => 'delete')) }}
                                         <button data-action="campagne {{ $campagne->sujet }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                        {{ Form::close() }}
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
