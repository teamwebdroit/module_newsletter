<div class="analyses">
    <div class="three-fourth">
        @if(!empty($analyses))
        <h4 class="title-section"><i class="fa fa-file-text"></i> &nbsp;&nbsp;Analyses</h4>

            @foreach($analyses as $analyse)

                <?php  $cats = implode(' ',$analyse->allcats); ?>
                <div class="analyse arret <?php echo $cats; ?> clear">
                    <div class="post">
                        <div class="post-title">
                            <h3 class="title">Analyse de {{ $analyse->authors }}</h3>
                            @if(!$analyse->analyses_arrets->isEmpty())
                                <ul>
                                    @foreach($analyse->analyses_arrets as $arret)
                                        <li>
                                            <a href="#{{ $arret->reference }}">{{ $arret->reference.' du '.$arret->pub_date->formatLocalized('%d %B %Y') }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <p>{{ $analyse->abstract }}</p>
                        </div><!--END POST-TITLE-->
                        <div class="post-entry">
                            @if(!empty($analyse->file ))
                                <p>
                                    <a target="_blank" href="{{ asset('files/analyses/'.$analyse->file) }}">
                                        Télécharger cette analyse en PDF &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </p>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        @else
        <p>&nbsp;</p>
        @endif

    </div>

    <div class="one-fifth last listCat listAnalyse">
        <img border="0" alt="Analyses" src="<?php echo asset('newsletter/pictos') ?>/analyse.png">
    </div>

    <span class="clear"></span>

    <div class="divider-border-nofloat"></div>
</div>
