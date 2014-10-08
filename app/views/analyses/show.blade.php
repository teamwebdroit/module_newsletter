@extends('layouts.admin')
@section('content')

    <div id="page-heading">
        <h1>Analyse
            @if ( !empty($analyse) )
                {{ $analyse->reference }}
            @endif
        </h1>
    </div>

    <div class="container">

        <div class="row"><!-- row -->
            <div class="col-md-12"><!-- col -->

                @if ( $analyse->pid == 195 )
                    <p><a class="btn btn-default" href="{{ url('admin/bail/analyses') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
                @endif
                @if ( $analyse->pid == 207 )
                    <p><a class="btn btn-default" href="{{ url('admin/matrimonial/analyses') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
                @endif

            </div>
        </div>

        <!-- start row -->
        <div class="row">

        @if ( !empty($analyse) )

            <div class="col-md-12">
                <div class="panel panel-sky">

                <!-- form start -->
                {{ Form::model($analyse,array(
                    'method'        => 'PUT',
                    'id'            => 'arret',
                    'data-validate' => 'parsley',
                    'class'         => 'validate-form form-horizontal',
                    'url'           => array('admin/arrets')))
                }}

                    <div class="panel-heading">
                        <h4>{{ $analyse->authors }}</h4>
                    </div>
                    <div class="panel-body event-info">

                        @if ( !empty($analyse) )
                        <h3>
                            @if ( $analyse->pid == 195 )
                                {{HTML::image('/images/bail/logo.png')}}
                            @endif
                            @if ( $analyse->pid == 207 )
                                {{HTML::image('/images/admin/matrimonial.jpg')}}
                            @endif
                        </h3>
                        @endif

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
                                        <a href=""><i class="fa fa-file"></i> &nbsp;&nbsp;{{ $analyse->file }}</a>
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

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Résumé</label>
                            <div class="col-sm-7">
                                {{ Form::textarea('abstract', $analyse->abstract , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Texte</label>
                            <div class="col-sm-7">
                                {{ Form::textarea('pub_text', $analyse->pub_text , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                            </div>
                        </div>

                        <?php

                            $arrets_analyses     = $analyse->arrets_analyses;
                            $hasArrets           = array();

                            $analyses_categories = $analyse->analyses_categories;
                            $hasCategorie        = array();

                            if( !$analyses_categories->isEmpty() )
                            {
                                foreach($analyses_categories as $analyses_categorie)
                                {
                                    $hasCategorie[] = $analyses_categorie->id;
                                }
                            }

                            if( !$arrets_analyses->isEmpty() )
                            {
                                foreach($arrets_analyses as $analyses_arret)
                                {
                                    $hasArrets[] = $analyses_arret->id;
                                }
                            }

                        ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Catégories</label>
                            <div class="col-sm-6">
                                <select name="categories[]" multiple="multiple" id="multi-select2">
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

                         <div class="form-group">
                            <label class="col-sm-3 control-label">Arrêts</label>
                            <div class="col-sm-6">
                                <select name="arrets[]" multiple="multiple" id="multi-select3">
                                    <?php
                                        foreach($arrets as $id => $arret)
                                        {
                                            echo '<option value="'.$id.'" ';

                                            if(in_array($id, $hasArrets))
                                            {
                                                echo 'selected';
                                            }

                                            echo ' >'.$arret.'</option>';
                                        }
                                    ?>
                                </select>
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

    </div><!-- end container -->

@stop