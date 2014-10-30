@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-brown">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;Campagnes</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="categories">
                        <thead>
                            <tr>
                                <th class="col-sm-2">Action</th>
                                <th class="col-sm-4">Titre</th>
                                <th class="col-sm-4">Images</th>
                                <th class="col-sm-2"></th>
                            </tr>
                        </thead>
                        <tbody class="selects">

                            @if(!empty($categories))
                            @foreach($categories as $categorie)
                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/categorie/'.$categorie->id) }}">&Eacute;diter</a></td>
                                <td><strong>{{ $categorie->title }}</strong></td>
                                <td><img height="60" src="{{ asset('newsletter/pictos/'.$categorie->image) }}" alt="{{ $categorie->title }}" /></td>
                                <td class="text-right">
                                    {{ Form::open(array('id' => 'deleteCategorieForm', 'route' => array('admin.categorie.destroy', $categorie->id), 'method' => 'delete')) }}
                                    {{ Form::close() }}
                                    <button data-id="{{ $categorie->id }}" class="btn btn-danger btn-sm deleteCategorie">Supprimer</button>

                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-sm-2">Action</th>
                                <th class="col-sm-4">Titre</th>
                                <th class="col-sm-4">Images</th>
                                <th class="col-sm-2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
