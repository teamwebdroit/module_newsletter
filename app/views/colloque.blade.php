
@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">Colloque</h1>
</div><!--END PAGE-HEADER-->

<div class="row">

    <div id="inner-content" class="col-md-8 col-xs-12">

            <h4 class="title-section">
                <a target="_blank" href="http://www2.unine.ch/cert"><img src="<?php echo asset('images/logos/cert.jpg');?>" alt="" /></a>
            </h4>
            <div class="post">
                <div class="post-holder">
                    <div class="post-content">

                        <div class="post-date">
                            <ul>
                                <li class="date"><span class="day">12</span><span class="month">Février</span> <span class="year">2015</span></li>
                            </ul>
                        </div><!--END POST-DATE-->

                        <div class="post-title">
                            <h2 class="title">
                                <a target="_blank" href="http://www.publications-droit.ch/index.php?id=275#/item/59">Conflits au travail<br/>
                                <strong>prévention, gestion, sanctions</strong></a>
                            </h2>
                        </div><!--END POST-TITLE-->

                        <div class="post-entry">
                            <p>Le but du séminaire est de répondre aux principales questions juridiques  concernant les conflits sur le lieu de travail en Suisse.</p>
                            <a target="_blank" href="http://www.publications-droit.ch/fileadmin/admin_unine/files/25848d41de2b2c8827ca7236954afbe8.pdf">
                                &nbsp;<i class="fa fa-file-o"></i> &nbsp;&nbsp;Le programme
                            </a>
                            <dl class="dl-horizontal">
                                <dt>Lieu:</dt>
                                    <dd>Aula des Jeunes Rives, Espace Louis-Agassiz 1, 2000 Neuchâtel</dd>
                                <dt>Date:</dt>
                                    <dd>12/02/15</dd>
                                <dt>Délai d'inscription:</dt>
                                    <dd>25/01/15</dd>
                                <dt>Prix d'inscription:</dt>
                                    <dd>Normal <strong>CHF 280.00</strong></dd>
                                    <dd>Stagiaires <strong>CHF 120.00</strong> </dd>
                            </dl>
                            <p><a target="_blank" href="http://www.publications-droit.ch/index.php?id=275#/item/59" class="button small grey">Inscription</a></p>

                        </div><!--END POST-ENTRY-->

                    </div><!--END POST-CONTENT -->
                </div><!--END POST-HOLDER -->

            </div><!--END POST-->

            <h4 class="title-section">
                <a target="_blank" href="http://www2.unine.ch/cemaj"><img src="<?php echo asset('images/logos/cemaj.jpg');?>" alt="" /></a>
            </h4>
            <div class="post nomarg">
                <div class="post-holder">
                    <div class="post-content">
                        <div class="post-date">
                            <ul>
                                <li class="date"><span class="day">6</span><span class="month">Novembre</span> <span class="year">2015</span></li>
                            </ul>
                        </div><!--END POST-DATE-->
                        <div class="post-title">
                            <h2 class="title">
                               Formation continue des avocats
                            </h2>
                        </div><!--END POST-TITLE-->
                    </div><!--END POST-CONTENT -->
                </div><!--END POST-HOLDER -->
            </div><!--END POST-->
            <div class="post nomarg">
                <div class="post-holder">
                    <div class="post-content">
                        <div class="post-date">
                            <ul>
                                <li class="date"><span class="day">13</span><span class="month">Novembre</span> <span class="year">2015</span></li>
                            </ul>
                        </div><!--END POST-DATE-->
                        <div class="post-title">
                            <h2 class="title">
                                New Developments in International Commercial Arbitration
                            </h2>
                        </div><!--END POST-TITLE-->

                    </div><!--END POST-CONTENT -->
                </div><!--END POST-HOLDER -->
            </div><!--END POST-->
        </div><!--END CONTENT-->

        <!-- Sidebar  -->
        <div id="sidebar" class="col-md-4 col-xs-12">
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

</div><!--END CONTENT-->

@stop