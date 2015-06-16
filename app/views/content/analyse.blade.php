<div class="analyses">
    <div class="row">
        <div class="col-md-9">
            @if(!empty($analyses))
            <h4 class="title-section"><i class="fa fa-file-text"></i> &nbsp;&nbsp;Analyses</h4>

                @foreach($analyses as $analyse)

                    <?php $analyse->load('auteur'); ?>
                    <?php $cats = implode(' ',$analyse->allcats); ?>

                    <div class="analyse arret <?php echo $cats; ?> clear">
                        <div class="post">
                            <div class="post-title">
                                <a class="anchor_top" name="analyse_{{ $analyse->id }}"></a>

                                @if(isset($analyse->auteur))
                                <div class="media">
                                    <div class="media-left">
                                        <img width="55" border="0" alt="{{ $analyse->auteur->name }}" src="{{ asset('authors/'.$analyse->auteur->photo) }}">
                                    </div>
                                    <div class="media-body bio-body">
                                        <h3 class="media-heading">{{ $analyse->auteur->name }}</h3>
                                        <h5>{{ $analyse->auteur->occupation }}</h5>
                                    </div>
                                </div><br/>
                                @endif

                                @if(!$analyse->analyses_arrets->isEmpty())
                                    <ul>
                                        @foreach($analyse->analyses_arrets as $arret)
                                            <li><a href="#{{ $arret->reference }}">{{ $arret->reference.' du '.$arret->pub_date->formatLocalized('%d %B %Y') }}</a></li>
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

        <div class="col-md-3 last listCat listAnalyse">
            <img border="0" alt="Analyses" src="<?php echo asset('newsletter/pictos') ?>/analyse.png">
        </div>
    </div>
    <div class="divider-border-nofloat"></div>
</div>
