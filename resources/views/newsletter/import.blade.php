@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">

                <form action="{{ url('admin/import') }}" data-validate="parsley" method="POST" enctype="multipart/form-data" class="validate-form form-horizontal">
                    {{ Form::token() }}
                    <div class="panel-heading">
                        <h4>Importer une liste</h4>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Format d'importation</label>
                            <div class="col-sm-6">
                                <p><a class="btn btn-default" target="_blank" href="{{ url('admin/exemple') }}"><i class="fa fa-download"></i> &nbsp;Liste d'exemple</a></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Fichier excel</label>
                            <div class="col-sm-6">
                                <input type="file" required name="file">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Nom de la liste</label>
                            <div class="col-sm-5">
                                <select class="form-control" required name="newsletter_id">
                                    <option value="">Choix de la newsletter</option>
                                    @if(!empty($newsletters))
                                        @foreach($newsletters as $list)
                                            <option value="{{ $list->id }}">{{ $list->titre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer mini-footer ">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
