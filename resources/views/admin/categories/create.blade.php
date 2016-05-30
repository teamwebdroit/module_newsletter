@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{!! url('admin/categorie') !!}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {!! Form::open(array(
                'method'        => 'POST',
                'id'            => 'categorie',
                'data-validate' => 'parsley',
                'files'         => true,
                'class'         => 'validate-form form-horizontal',
                'url'           => array('admin/categorie')))
            !!}

            <div class="panel-heading">
                <h4>Ajouter une catégorie</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-3">
                        {!! Form::text('title', null , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-7">
                        <div class="list-group">
                            <div class="list-group-item">
                                {!! Form::file('file') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégorie principale ?</label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" name="ismain" checked value="0"> Non
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="ismain" value="1"> Oui
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Invisible sur site ?</label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" name="hideOnSite" checked value="0"> Non
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="hideOnSite" value="1"> Oui
                        </label>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('user_id', 1 )!!}
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</div>
<!-- end row -->

@stop