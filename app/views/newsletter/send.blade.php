@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h3>Envoyer la campagne </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4><i class="fa fa-rocket"></i> &nbsp;</h4>
            </div>
            <div class="panel-body">

                @if(!empty($statistiques))
                    <?php
                        echo $campagne->api_campagne_id;
                        echo '<pre>';
                        print_r($statistiques);
                        echo '</pre>';
                    ?>
                @endif

            </div>
        </div>

    </div>
</div>

@stop