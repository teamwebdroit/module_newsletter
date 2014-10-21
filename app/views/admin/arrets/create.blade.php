@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/arret') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-midnightblue">

            <!-- form start -->
            {{ Form::open(array(
                'method'        => 'POST',
                'id'            => 'arret',
                'data-validate' => 'parsley',
                'files'         => true,
                'class'         => 'validate-form form-horizontal',
                'url'           => array('admin/arret') ))
            }}

            <div class="panel-heading">
                <h4>Créer arrêt</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Référence</label>
                    <div class="col-sm-3">
                        {{ Form::text('reference', null , array('class' => 'form-control') ) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-sm-2">
                        {{ Form::text('pub_date', null , array('class' => 'form-control datePicker') ) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Fichier</label>
                    <div class="col-sm-7">
                        {{ Form::file('file') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="analysis" class="col-sm-3 control-label">Analyse</label>
                    <div class="col-sm-7">
                        {{ Form::file('analysis') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Résumé</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('abstract', null , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Texte</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('pub_text', null , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégories</label>
                    <div class="col-sm-6">
                        <select multiple="multiple" name="categories[]" id="multi-select">
                            <?php
                                foreach($categories as $categorie)
                                {
                                    echo '<option value="'.$categorie->id.'">'.$categorie->title.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-3">{{ Form::hidden('user_id', 1 )}}</div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

</div>
<!-- end row -->

@stop