@extends('layouts.admin')
@section('content')

<?php $custom = new \Custom; ?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-folder"></i> &nbsp;Fichierss</h4>
                </div>
                <div class="panel-body">

                   	<div class="filemanager">
                   		<div class="search">
                   			<input type="search" placeholder="Find a file.." />
                   		</div>
                   		<div class="breadcrumbs"></div>
                   		<ul class="data"></ul>
                   		<div class="nothingfound">
                   			<div class="nofiles"></div>
                   			<span>No files here.</span>
                   		</div>
                   	</div>

                </div>
            </div>

        </div>
    </div>

@stop