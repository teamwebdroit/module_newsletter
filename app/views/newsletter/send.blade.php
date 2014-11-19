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

                @if(!empty($statistiques))
                    <?php
                        echo $campagne->api_campagne_id;
                        echo '<pre>';
                        print_r($charts->chartDoughnut($statistiques));
                        echo '</pre>';
                    ?>
                @endif

                @if(!empty($listStats))
                    <?php
                        echo '<pre>';
                        print_r($listStats);
                        echo '</pre>';
                    ?>
                @endif

                @if(!empty($senderList))
                    <?php
                        echo '<pre>';
                        print_r($senderList);
                        echo '</pre>';
                    ?>
                @endif


                <script type="text/javascript">
                    window.onload = function(){
                        var doughnutData = <?php echo json_encode($doughnut); ?>;
                        console.log(doughnutData);
                        var myDoughnut   = new Chart(document.getElementById("donut-chart").getContext("2d")).Doughnut(doughnutData);
                    };
                </script>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4>Bar Chart</h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="bar-chart" height="300"  width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4>Pie Chart</h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="donut-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4>Polar Area Chart</h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="pie-chart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>

@stop