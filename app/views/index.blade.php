
@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">Nouveautés dans le domaine du droit du travail</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section">
        <div id="inner-content">

            @include('partials.message')

            <div class="one" id="about">
                <img width="100%" alt="Droit du travail" src="{{ asset('images/header.jpg') }}" />
            </div><!--END SECTION-->
            <div class="clear"></div>

            <div class="one">
                <h3 class="title">Droit du travail</h3>
                <p>
                    Le site « droitdutravail.ch », créé sous l’égide de la Faculté de droit de <a href="http://www2.unine.ch/" target="_blank">l’Université de Neuchâtel</a> ,
                    est dédié aux nouveautés en droit du travail, en particulier la jurisprudence du Tribunal fédéral.
                    Le site est placé sous la responsabilité des professeurs François Bohnet (co-directeur du <a href="http://www2.unine.ch/cemaj" target="_blank">CEMAJ</a>),
                    Jean-Philippe Dunand (co-directeur du <a href="http://www2.unine.ch/cert" target="_blank">CERT</a>) et Pascal Mahon (co-directeur du <a href="http://www2.unine.ch/cert" target="_blank">CERT</a>),
                    avec la collaboration de Mme Patricia Dietschy, docteure en droit et vice-présidente dans un tribunal de prud'hommes.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="clear"></div>
            <div class="divider-border"></div>

            <div class="one-half">
                <h4 class="title">Le Centre d’étude des relations de travail (CERT)</h4>
                <p>
                    Le Centre d’étude des relations de travail, créé et dirigé par les prof. Jean-Philippe Dunand et Pascal Mahon est
                    rattaché à la Faculté de droit de l’Université de Neuchâtel. Il a pour but d’étudier la relation de travail
                    dans tous ses aspects, y compris les spécificités et les liens entre le droit privé et le droit public du travail.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="one-half last">
                <h4 class="title">Activités du CERT</h4>
                <p>
                    Les membres du CERT donnent des cours universitaires, mettent sur pied des séminaires de formation continue et des
                    colloques, rédigent et publient diverses contributions, encouragent la publication de travaux scientifiques
                    dans la collection juridique du Centre et rédigent des avis de droit (pour toute information : <a href="http://www2.unine.ch/cert" target="_blank">www.unine.ch/CERT</a> ).
                </p>
            </div><!--END ONE-THIRD-->

            <div class="clear"></div>
            <div class="divider-border"></div>

            <div class="one">
                <h4 class="title">CEMAJ</h4>
                <p>Le <a href="http://www2.unine.ch/cemaj" target="_blank">CEMAJ</a>, Centre de recherche sur les modes amiables et juridictionnels de gestion des conflits, développe la
                    recherche et la formation et propose ses services dans le domaine des modes amiables (négociation, médiation,
                    conciliation et arbitrage) et juridictionnels (droit des procédures) de règlement des conflits, en mettant
                    l'accent en particulier sur la question de l'harmonisation et de l'articulation de ces processus complémentaires.</p>
            </div>
            <div class="divider-noborder"></div>
        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop