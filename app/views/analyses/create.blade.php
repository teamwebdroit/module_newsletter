@extends('layouts.admin')
@section('content')

    <div id="page-heading">
        <h1>Nouvel analyse</h1>
    </div>

    <div class="container">

        <div class="row"><!-- row -->
            <div class="col-md-12"><!-- col -->

                @if ( $pid == 195 )
                    <p><a class="btn btn-default" href="{{ url('admin/bail/analyses') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
                @endif
                @if ( $pid== 207 )
                    <p><a class="btn btn-default" href="{{ url('admin/matrimonial/analyses') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
                @endif

            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-sky">

                    <!-- form start -->
                    {{ Form::open(array(
                        'method'        => 'POST',
                        'id'            => 'analyse',
                        'data-validate' => 'parsley',
                        'files'         => true,
                        'class'         => 'validate-form form-horizontal',
                        'url'           => array('admin/analyses') ))
                    }}

                    <div class="panel-heading">
                        <h4>Ajouter</h4>
                    </div>
                    <div class="panel-body event-info">

                        @if ( !empty($pid) )
                        <h3>
                            @if ( $pid == 195 )
                                {{HTML::image('/images/bail/logo.png')}}
                                {{ Form::hidden('pid', $pid )}}
                            @endif
                            @if ( $pid== 207 )
                                {{HTML::image('/images/admin/matrimonial.jpg')}}
                                {{ Form::hidden('pid', $pid )}}
                            @endif
                        </h3>
                        @endif

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
                                <select name="categories[]" multiple="multiple" id="multi-select2">
                                    <?php
                                        foreach($categories as $categorie)
                                        {
                                            echo '<option value="'.$categorie->id.'">'.$categorie->title.'</li>';
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
                                            echo '<option value="'.$id.'">'.$arret.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                         </div>

                    </div>
                    <div class="panel-footer mini-footer ">
                        <div class="col-sm-3">{{ Form::hidden('cruser_id', 1 )}}</div>
                        <div class="col-sm-6">
                            <button class="btn btn-primary" type="submit">Envoyer </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
        <!-- end row -->

    </div><!-- end container -->

@stop