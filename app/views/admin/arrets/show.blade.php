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
            'method'        => 'PUT',
            'id'            => 'arret',
            'files'         => true,
            'data-validate' => 'parsley',
            'class'         => 'validate-form form-horizontal',
            'url'           => array('admin/arret/'.$arret->id)))
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
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" <?php echo ($arret->dumois ? 'checked' : ''); ?> name="dumois"> Arrêt du mois
                            </label>
                        </div>
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
                                <a target="_blank" href="{{ asset('files/arrets/'.$arret->file) }}">
                                    <i class="fa fa-file"></i> &nbsp;&nbsp;
                                    {{ $arret->file }}
                                </a>
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
                        {{ Form::textarea('abstract', $arret->abstract , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Texte</label>
                    <div class="col-sm-7">
                        {{ Form::textarea('pub_text', $arret->pub_text , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                    </div>
                </div>

                <?php

                    $hasCategorie = array();
                    $hasIds       = array();

                    $isCategories = $categories->lists('title','id');

                    if( !$arret->arrets_categories->isEmpty() )
                    {
                        $hasCategorie = $arret->arrets_categories->lists('title','id');
                        $hasIds       = $arret->arrets_categories->lists('id');
                    }

                    $categories = array_diff_key($isCategories,$hasIds);

                ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégories</label>

                    <div class="col-sm-9" ng-app="selection">
                        <div ng-controller="MultiSelectionController as selectcat">
                            <div class="listArrets forArrets" ng-init="typeItem='categories';uidContent='{{ $arret->id }}';itemContent='arrets'">
                                <div ng-repeat="(listName, list) in selectcat.models.lists">
                                    <ul class="list-arrets" dnd-list="list">
                                        <li ng-repeat="item in list"
                                            dnd-draggable="item"
                                            dnd-moved="list.splice($index, 1); logEvent('Container moved', event); selectcat.dropped(item)"
                                            dnd-effect-allowed="move"
                                            dnd-selected="models.selected = item"
                                            ng-class="{'selected': models.selected === item}" >
                                            {[{ item.title }]} <small ng-show="selectcat.showImageName(item.title)"> - {[{ item.image }]}</small>
                                            <input type="hidden" name="categories[]" ng-if="item.isSelected" value="{[{ item.itemId }]}" />
                                        </li>
                                    </ul>
                                </div>
                                <div view-source="simple"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {{ Form::hidden('id', $arret->id )}}
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