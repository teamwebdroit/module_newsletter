@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-top: -50px;margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/categorie/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;Catégories</h4>
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
                                        {{ Form::open(array('route' => array('admin.categorie.destroy', $categorie->id), 'method' => 'delete')) }}
                                            <button data-id="{{ $categorie->id }}" class="btn btn-danger btn-sm deleteCategorie">Supprimer</button>
                                        {{ Form::close() }}
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


        <!-- Modal -->
        <div class="modal fade" id="deleteCategorie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Annuler</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Suppression de la catégorie</h4>
                    </div>
                    <div class="modal-body" id="modalCategorie">
                        <p>Etês-vous sûr de vouloir supprimer cette catégorie?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop