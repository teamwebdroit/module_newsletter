<div class="edit_content">

    @if(isset($bloc->arrets))

        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr><!-- space -->
            <tr bgcolor="ffffff">
                <td width="400" align="left" class="resetMarge contentForm" valign="top">
                    <h3 style="text-align: left;">{{ $allcategories[$bloc->categorie] }}</h3>
                </td>
                <td width="160" align="center" valign="top" class="resetMarge">
                    <img width="130" border="0" src="{{ asset('newsletter/pictos/'.$bloc->image) }}" alt="{{ $allcategories[$bloc->categorie] }}" />
                </td>
            </tr><!-- space -->
        </table>
        <!-- Bloc content-->

        @foreach($bloc->arrets as $arret)

            <!-- Bloc content-->
            <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
                <tr bgcolor="ffffff">
                    <td colspan="3" height="35">
                        <div class="pull-right btn-group btn-group-xs">
                            <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{{ $bloc->idItem }}" data-action="{{ $arret->reference }}" type="button">&nbsp;×&nbsp;</button>
                        </div>
                    </td>
                </tr><!-- space -->
                <tr>
                    <td valign="top" width="375" class="resetMarge contentForm">
                        <div>
                            <?php setlocale(LC_ALL, 'fr_FR.UTF-8');?>
                            <h3 style="text-align: left;">{{ $arret->reference }} du {{ $arret->pub_date->formatLocalized('%d %B %Y') }}</h3>
                            <p class="abstract">{{ $arret->abstract }}</p>
                            <div>{{ $arret->pub_text }}</div>
                        </div>
                    </td>
                    <td width="25" class="resetMarge"></td><!-- space -->
                    <td align="center" valign="top" width="160" class="resetMarge">
                        <!-- Categories -->
                        <div class="resetMarge">
                            <?php
                            if(!$arret->arrets_categories->isEmpty() )
                            {
                                foreach($arret->arrets_categories as $categorie)
                                {
                                    if($categorie->id != $bloc->categorie){
                                        echo '<a target="_blank" href="'.url('jurisprudence').'#'.$arret->reference.'"><img width="130" border="0" alt="'.$categorie->title.'" src="'.asset('newsletter/pictos/'.$categorie->image).'"></a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
            </table>
            <!-- Bloc content-->

        @endforeach
    @endif
</div>
