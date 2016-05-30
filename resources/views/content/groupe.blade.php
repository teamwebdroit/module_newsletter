
@if(isset($bloc->arrets))

    <div class="row">
        <div class="col-md-9">
            <h3 style="text-align: left;">{{ $allcategories[$bloc->categorie] }}</h3>
        </div>
        <div class="col-md-3 listCat">
            <img width="130" border="0" src="{{ asset('newsletter/pictos/'.$bloc->image) }}" alt="{{ $allcategories[$bloc->categorie] }}" />
        </div>
    </div>

    <!-- Bloc content-->
    @foreach($bloc->arrets as $arret)

        <div class="row">
            <div class="col-md-9">
                <div class="post">
                    <div class="post-title">
                        <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                        <h2 class="title">{{ $arret->reference }} du {{ $arret->pub_date->formatLocalized('%d %B %Y') }}</h2>
                        <p>{{ $arret->abstract }}</p>
                    </div><!--END POST-TITLE-->
                    <div class="post-entry">
                        {{ $arret->pub_text }}
                    </div>
                </div><!--END POST-->
            </div>
            <div class="col-md-3 listCat">
                <?php
                if(!$arret->arrets_categories->isEmpty() )
                {
                    foreach($arret->arrets_categories as $categorie)
                    {
                        if($categorie->id != $bloc->categorie){
                            echo '<a target="_blank" href="'.url('jurisprudence').'#'.$arret->reference.'"><img width="130" border="0" alt="Loyer" src="'.asset('newsletter/pictos/'.$categorie->image).'"></a>';
                        }
                    }
                }
                ?>
            </div>
        </div>

    @endforeach
@endif


