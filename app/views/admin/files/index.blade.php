@extends('layouts.admin')
@section('content')

<?php $custom = new \Custom; ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-folder"></i> &nbsp;Fichiers</h4>
                </div>
                <div class="panel-body">

                    <div class="btn-toolbar pull-right">
                        <div class="btn-group btn-group-sm">
                            <a href='#' class="btn btn-sky">
                                <i class="fa fa-folder"></i> &nbsp;Ajouter un fichier</span>
                            </a>
                            <a href='#' class="btn btn-brown">
                                <i class="fa fa-folder"></i> &nbsp;Ajouter un dossier</span>
                            </a>
                        </div>
                    </div>

                   	<div class="filemanager">
                   		<div class="search">
                   			<input type="search" placeholder="Rechercher un Fichier..." />
                   		</div>
                   		<div class="breadcrumbs"></div>
                   		<ul class="data"></ul>
                   		<div class="nothingfound">
                   			<div class="nofiles"></div>
                   			<span>Aucun fichier</span>
                   		</div>
                   	</div>

                </div>
            </div>

        </div>
    </div>

    <div id="gallarymodal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Heading</h3>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Annuler</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Suppression de la catégorie</h4>
                </div>
                <div class="modal-body">
                    <p>&Ecirc;tes-vous sûr de vouloir supprimer cette image?</p>
                    <div id="modalImage"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="button" id="deleteImageConfirm" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>


@stop