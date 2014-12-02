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

@stop