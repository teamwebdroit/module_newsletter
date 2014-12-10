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
                'id'            => 'analyse',
                'data-validate' => 'parsley',
                'files'         => true,
                'class'         => 'validate-form form-horizontal',
                'url'           => array('admin/analyse') ))
            }}

            <div class="panel-heading">
                <h4>Créer analyse</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Auteurs</label>
                    <div class="col-sm-3">
                        {{ Form::text('authors', null , array('class' => 'form-control') ) }}
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
                    <label for="message" class="col-sm-3 control-label">Résumé</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('abstract', null , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégories</label>
                    <div class="col-sm-6">
                        <select name="categories[]" multiple="multiple" id="multi-select">
                            <?php
                                if(!empty($categories)){
                                    foreach($categories as $categorie)
                                    {
                                        echo '<option value="'.$categorie->id.'">'.$categorie->title.'</li>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Arrêts</label>
                    <div class="col-sm-6">
                        <select name="arrets[]" multiple="multiple" id="multi-select2">
                            <?php
                                if(!empty($arrets)){
                                    foreach($arrets as $arret)
                                    {
                                        echo '<option value="'.$arret->id.'">'.$arret->reference.'</option>';
                                    }
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
	
    	
@stop