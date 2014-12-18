@extends('layouts.admin')
@section('content')

<?php  $charts = new \Charts; ?>

<div class="row">
    <div class="col-md-12">
        <h3>Statistiques de la campagne </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <script type="text/javascript">
            window.onload = function(){
                $.plot($("#interactive"), <?php echo json_encode($charts->myPieChart($statistiques)); ?>,
                    {
                        series: {
                            pie: { show: true}
                        },
                        grid: {
                            hoverable: true,
                            clickable: true
                        },
                        legend: { show: false }
                    });
            };
        </script>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Interactive</h4>
                    </div>
                    <div class="panel-body">
                        <div id="interactive" style="width:100%; height: 300px" class="centered"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop