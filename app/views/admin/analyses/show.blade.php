@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/analyse') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if ( !empty($analyse) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {{ Form::model($analyse,array(
                'method'        => 'PUT',
                'id'            => 'analyse',
                'files'         => true,
                'data-validate' => 'parsley',
                'class'         => 'validate-form form-horizontal',
                'url'           => array('admin/analyse/'.$analyse->id)))
            }}

            <div class="panel-heading">
                <h4>&Eacute;diter l'analyse de {{ $analyse->authors }}</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Auteurs</label>
                    <div class="col-sm-3">
                        {{ Form::text('authors', $analyse->authors , array('class' => 'form-control') ) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-sm-2">
                        {{ Form::text('pub_date', $analyse->pub_date->format('Y-m-d') , array('class' => 'form-control datePicker') ) }}
                    </div>
                </div>

                @if(!empty($analyse->file ))
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Fichier</label>
                    <div class="col-sm-7">
                        <div class="list-group">
                            <div class="list-group-item">
                                <a target="_blank" href="{{ asset('files/analyses/'.$analyse->file) }}">
                                <i class="fa fa-file"></i> &nbsp;&nbsp;{{ $analyse->file }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Changer le fichier</label>
                    <div class="col-sm-7">
                        {{ Form::file('file') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Résumé</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('abstract', $analyse->abstract , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <?php

                    $hasArrets    = array();
                    $hasCategorie = array();

                    if( !$analyse->analyses_categories->isEmpty() )
                    {
                        foreach($analyse->analyses_categories as $analyses_categorie)
                        {
                            $hasCategorie[] = $analyses_categorie->id;
                        }
                    }

                    if( !$analyse->analyses_arrets->isEmpty() )
                    {
                        foreach($analyse->analyses_arrets as $analyses_arrets)
                        {
                            $hasArrets[] = $analyses_arrets->id;
                        }
                    }

                    $hasCategorie = array();
                    $hasArrets    = array();
                    $hasCatIds    = array();
                    $hasArretIds  = array();

                    $isCategories = $categories->lists('title','id');
                    $isArrets     = $arrets->lists('reference','id');

                    if( !$analyse->analyses_categories->isEmpty() )
                    {
                        $hasCategorie = $analyse->analyses_categories->lists('title','id');
                        $hasCatIds    = $analyse->analyses_categories->lists('id');
                    }

                    if( !$analyse->analyses_arrets->isEmpty() )
                    {
                        $hasArrets   = $analyse->analyses_arrets->lists('reference','id');
                        $hasArretIds = $analyse->analyses_arrets->lists('id');
                    }

                    $categories = array_diff_key($isCategories,$hasCatIds);
                    $arrets     = array_diff_key($isArrets,$hasArretIds);

                ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégories</label>
                    <div class="col-sm-9">

                        <div id="fieldChooser" tabIndex="1">
                            <div id="sourceFields">
                                <?php
                                foreach($categories as $id => $categorie)
                                {
                                    echo '<div>'.$categorie.'<input type="hidden" disabled="disabled" value="'.$id.'" name="categories[]"></div>';
                                }
                                ?>
                            </div>
                            <div id="destinationFields">
                                <?php
                                if(!empty($hasCategorie))
                                {
                                    foreach($hasCategorie as $hasid => $has)
                                    {
                                        echo '<div>'.$has.'<input type="hidden" value="'.$hasid.'" name="categories[]"></div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Arrêts</label>
                    <div class="col-sm-9">

                        <div id="fieldChooser2" tabIndex="1">
                            <div id="sourceFields2">
                                <?php
                                foreach($arrets as $id => $arret)
                                {
                                    echo '<div>'.$arret.'<input type="hidden" disabled="disabled" value="'.$id.'" name="arrets[]"></div>';
                                }
                                ?>
                            </div>
                            <div id="destinationFields2">
                                <?php
                                if(!empty($hasArrets))
                                {
                                    foreach($hasArrets as $hasarretid => $hasArret)
                                    {
                                        echo '<div>'.$hasArret.'<input type="hidden" value="'.$hasarretid.'" name="arrets[]"></div>';
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {{ Form::hidden('id', $analyse->id )}}
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