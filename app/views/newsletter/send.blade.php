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

                <?php $charts = new \Charts; ?>

                <?php
                    list($list,$max) = $charts->allYearStats($statsListe);

                    echo 'max: '.$max;
                    echo '<pre>';
                    print_r($list);
                    echo '</pre>';
                ?>

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

                        /////////////////////////////////////////
                        var d1 = [];
                        for (var i = 0; i <= 10; i += 1) {
                            d1.push([i, parseInt(Math.random() * 30)]);
                        }

                        var d2 = [];
                        for (var i = 0; i <= 10; i += 1) {
                            d2.push([i, parseInt(Math.random() * 30)]);
                        }

                        var d3 = [];
                        for (var i = 0; i <= 10; i += 1) {
                            d3.push([i, parseInt(Math.random() * 30)]);
                        }

                        function plotWithOptions() {
                            $.plot("#stacking", [ d1, d2, d3 ], {
                                series: {
                                    stack: true,
                                    lines: {
                                        show: true,
                                        fill: true,
                                        steps: false
                                    }
                                }
                            });
                        }

                        plotWithOptions();
                        /////////////////////////////////////////
                    };
                </script>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Stacking</h4>
                            </div>
                            <div class="panel-body">
                                <div id="stacking" style="height: 300px" class="centered"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4>Bar Chart</h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="bar-chart" height="300" width="300"></canvas>
                            </div>
                        </div>
                    </div>
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

    </div>
</div>

@stop