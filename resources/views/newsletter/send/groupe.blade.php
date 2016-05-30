@if(isset($bloc->arrets))

<!-- Bloc -->
<table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="tableReset">
    <tr bgcolor="ffffff"><td height="35"></td></tr><!-- space -->
    <tr align="center" class="resetMarge">
        <td class="resetMarge">
            <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
                <tr bgcolor="ffffff"><td colspan="3" height="20"></td></tr><!-- space -->
                <tr bgcolor="ffffff">
                    <td width="400" align="left" class="resetMarge contentForm" valign="top">
                        <h3 style="text-align: left;font-family: sans-serif;">{!! $allcategories[$bloc->categorie] !!}</h3>
                    </td>
                    <td width="160" align="center" valign="top" class="resetMarge">
                        <img width="130" border="0" src="{!! asset('newsletter/pictos/'.$bloc->image) !!}" alt="{!! $allcategories[$bloc->categorie] !!}" />
                    </td>
                </tr><!-- space -->
            </table>
        </td>
    </tr>
    <tr bgcolor="ffffff"><td height="20" class="blocBorder"></td></tr><!-- space -->

    @foreach($bloc->arrets as $arret)

        <tr align="center" class="resetMarge">
            <td class="resetMarge">

                <!-- Bloc content-->
                <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
                    <tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr><!-- space -->
                    <tr>
                        <td valign="top" width="375" class="resetMarge contentForm">
                            <div>
                                <?php
                                $title = ($arret->dumois ? 'Arrêt du mois : ' : '');
                                setlocale(LC_ALL, 'fr_FR.UTF-8');
                                ?>
                                <h3 style="text-align: left;font-family: sans-serif;">{!! $title !!}{{ $arret->reference }} du {!! $arret->pub_date->formatLocalized('%d %B %Y') !!}</h3>
                                <p class="abstract">{!! $arret->abstract !!}</p>
                                <div>{!! $arret->pub_text !!}</div>
                                <p><a href="{!! asset('files/arrets/'.$arret->file) !!}">Télécharger en pdf</a></p>
                            </div>
                        </td>
                        <td width="25" height="1" class="resetMarge" valign="top" style="font-size: 1px; line-height: 1px;margin: 0;padding: 0;"></td><!-- space -->
                        <td align="center" valign="top" width="160" class="resetMarge">
                            <!-- Categories -->
                            <div class="resetMarge">
                                <?php
                                if(!$arret->arrets_categories->isEmpty() )
                                {
                                    echo '<table border="0" width="160" align="center" cellpadding="0" cellspacing="0">';
                                    foreach($arret->arrets_categories as $categorie)
                                    {
                                        if($categorie->id != $bloc->categorie){
                                            echo '<tr align="center" style="margin: 0;padding: 0;"><td style="margin: 0;padding: 0;page-break-before: always;" valign="top">';
                                            echo '<a target="_blank" href="'.url('jurisprudence').'#'.$arret->reference.'" style="margin:0;padding:0;display: block;">
                                                    <img style="margin:0;padding:0;display: block;" width="130" border="0" alt="'.$categorie->title.'" src="'.asset('newsletter/pictos/'.$categorie->image).'">
                                                </a>';
                                            echo '</td></tr>';
                                        }
                                    }
                                    echo '</table>';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        @if($arret->arrets_analyses->isEmpty())
            <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
        @endif

        <!-- Analyses if any -->
        @if(isset($arret->arrets_analyses) && !$arret->arrets_analyses->isEmpty())
            <tr align="center" class="resetMarge">
                <td class="resetMarge">
                    @include('newsletter.build.edit.analyse',['arret' => $arret])
                </td>
            </tr>
            <tr bgcolor="ffffff"><td height="35" colspan="3" class="blocBorder"></td></tr><!-- space -->
        @endif

    @endforeach

</table>
<!-- End bloc -->

@endif