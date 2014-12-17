
@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">
            <h1 class="title uppercase">Nouveautés dans le domaine du droit du travail</h1>
        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">

    <div id="inner-content" class="col-md-8">

        @include('partials.message')

        <div id="about">
            <img width="100%" alt="Droit du travail" src="{{ asset('images/header.jpg') }}" />
        </div><!--END SECTION-->

        <div class="row"><!-- Start row -->

            <div class="col-md-12">
                <h3 class="title">Droit du travail.ch</h3>
                <p>
                    Le site « droitdutravail.ch », créé sous l’égide de la Faculté de droit de <a href="http://www2.unine.ch/" target="_blank">l’Université de Neuchâtel</a> ,
                    est dédié aux nouveautés en droit du travail, en particulier la jurisprudence du Tribunal fédéral.
                    Le site est placé sous la responsabilité des professeurs François Bohnet (co-directeur du <a href="http://www2.unine.ch/cemaj" target="_blank">CEMAJ</a>),
                    Jean-Philippe Dunand (co-directeur du <a href="http://www2.unine.ch/cert" target="_blank">CERT</a>) et Pascal Mahon (co-directeur du <a href="http://www2.unine.ch/cert" target="_blank">CERT</a>),
                    avec la collaboration de Mme Patricia Dietschy, docteure en droit et vice-présidente dans un tribunal de prud'hommes.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="divider-border"></div>

            <div class="col-md-6">
                <h4 class="title">Centre d’étude des relations de travail (CERT)<br/>&nbsp;</h4>
                <p>Le <a href="http://www2.unine.ch/cert" target="_blank">CERT</a>, Centre d’étude des relations de travail, créé et dirigé par les prof. Jean-Philippe Dunand et Pascal Mahon est
                    rattaché à la Faculté de droit de l’Université de Neuchâtel. Il a pour but d’étudier la relation de travail
                    dans tous ses aspects, y compris les spécificités et les liens entre le droit privé et le droit public du travail.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="col-md-6">
                <h4 class="title">Centre de recherche sur les modes amiables et juridictionnels de gestion des conflits (CEMAJ)</h4>
                <p>Le <a href="http://www2.unine.ch/cemaj" target="_blank">CEMAJ</a>, Centre de recherche sur les modes amiables et juridictionnels de gestion des conflits, développe la
                    recherche et la formation et propose ses services dans le domaine des modes amiables (négociation, médiation,
                    conciliation et arbitrage) et juridictionnels (droit des procédures) de règlement des conflits, en mettant
                    l'accent en particulier sur la question de l'harmonisation et de l'articulation de ces processus complémentaires.</p>

            </div><!--END ONE-THIRD-->

            <div class="clear"></div>
            <div class="divider-border"></div>

            <div class="col-md-12">
                <h4 class="title">Activités du CERT et du CEMAJ</h4>
                <p>Les membres du CERT et du CEMAJ donnent des cours universitaires, mettent sur pied des séminaires de formation continue
                    et des colloques, rédigent et publient diverses contributions, encouragent la publication de travaux scientifiques dans
                    les collections juridiques des Centres et rédigent des avis de droit. <br/>(pour toute information :
                    <a href="http://www2.unine.ch/cert" target="_blank">www.unine.ch/CERT</a> et <a href="http://www2.unine.ch/cemaj" target="_blank">www.unine.ch/CEMAJ</a>)
                </p>
            </div>
            <div class="divider-noborder"></div>

        </div><!-- end row -->

    </div>

    <!-- Sidebar  -->
    <div id="sidebar" class="col-md-4 col-xs-12">
        @include('partials.newsletter')
        @include('partials.pub')
        @include('partials.soutiens')
        @include('partials.latest')
    </div>
    <!-- END Sidebar  -->

</div><!--END CONTENT-->

@stop