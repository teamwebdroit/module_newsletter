@extends('layouts.master')
@section('content')

<?php $custom = new \Custom; ?>

<div class="page-header text-align-left">
    <h1 class="title uppercase">Recueil de jurisprudence neuchâteloise</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section">
        <div id="inner-content" class="blog3">

            @if(!empty($arrets))
                @foreach($arrets as $arret)
                <div class="post">
                    <div class="post-title">
                        <?php setlocale(LC_ALL, 'fr_FR');  ?>
                        <h2 class="title"><a href="blog-single.html">{{ $arret->reference }} du {{ $arret->pub_date->formatLocalized('%d %B %Y') }}</a></h2>
                        <div class="post-date">
                            <ul>
                                @if(!$arret->arrets_categories->isEmpty())
                                    @foreach($arret->arrets_categories as $arrets_categorie)
                                        <li class="date">{{ $arrets_categorie->title }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div><!--END POST-DATE-->
                        <p>{{ $arret->abstract }}</p>
                    </div><!--END POST-TITLE-->
                    <div class="post-entry">
                        <p>{{ $arret->pub_text }}</p>
                    </div>
                </div><!--END POST-->
                @endforeach

                <!--Pagination -->
                {{ $arrets->links() }}

            @endif

        </div><!--END INNER-CONTENT-->

        <!-- Sidebar  -->
        @include('partials.sidebar')
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
