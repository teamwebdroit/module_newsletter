@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
         <p><a class="btn btn-default" href="{{ url('admin/arret') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

@if ( !empty($arret) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

        <!-- form start -->
        {{ Form::model($arret,array(
            'method'        => 'POST',
            'id'            => 'arret',
            'data-validate' => 'parsley',
            'class'         => 'validate-form form-horizontal',
            'url'           => array('admin/arret')))
        }}

            <div class="panel-heading">
                <h4>&Eacute;diter {{ $arret->reference }}</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Référence</label>
                    <div class="col-sm-3">
                        {{ Form::text('reference', $arret->reference , array('class' => 'form-control') ) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-sm-2">
                        {{ Form::text('pub_date', $arret->pub_date->format('Y-m-d') , array('class' => 'form-control datePicker') ) }}
                    </div>
                </div>

                @if(!empty($arret->file ))
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Fichier</label>
                    <div class="col-sm-7">
                        <div class="list-group">
                            <div class="list-group-item">
                                <a href=""><i class="fa fa-file"></i> &nbsp;&nbsp;{{ $arret->file }}</a>
                                <button class="btn btn-xs btn-danger pull-right" type="button">X</button>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Fichier</label>
                    <div class="col-sm-7">
                        {{ Form::file('file') }}
                    </div>
                </div>
                @endif

                @if(!empty($arret->analysis ))
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Analyse</label>
                    <div class="col-sm-7">
                        <div class="list-group">
                            <div class="list-group-item">
                                <a href=""><i class="fa fa-file"></i> &nbsp;&nbsp;{{ $arret->analysis }}</a>
                                <button class="btn btn-xs btn-danger pull-right" type="button">X</button>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Analyse</label>
                    <div class="col-sm-7">
                        {{ Form::file('analysis') }}
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Résumé</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('abstract', $arret->abstract , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Texte</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('pub_text', $arret->pub_text , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <?php

                    $arrets_categories = $arret->arrets_categories;
                    $hasCategorie      = array();

                    if( !$arrets_categories->isEmpty() )
                    {
                        foreach($arrets_categories as $arrets_categorie)
                        {
                            $hasCategorie[] = $arrets_categorie->id;
                        }
                    }
                ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégories</label>
                    <div class="col-sm-6">
                        <select multiple="multiple" name="categories[]" id="multi-select">
                            <?php
                                foreach($categories as $categorie)
                                {
                                    echo '<option value="'.$categorie->id.'" ';

                                    if(in_array($categorie->id, $hasCategorie))
                                    {
                                        echo 'selected';
                                    }

                                    echo ' >'.$categorie->title.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {{ Form::hidden('id', $arret->id )}}
                {{ Form::hidden('user_id', 1 )}}
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
        {{ Form::close() }}
        </div>
    </div>

@endif

</div>
<!-- end row -->

@stop