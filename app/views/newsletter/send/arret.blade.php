<!-- Bloc -->
<table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="tableReset">
    <tr bgcolor="ffffff">
        <td colspan="3" height="35"></td>
    </tr><!-- space -->
    <tr align="center" class="resetMarge">
        <td class="resetMarge">
            <!-- Bloc content-->
            <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="tableReset contentForm">
                <tr>
                    <td valign="top" width="375" class="resetMarge">
                        <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                        <h3 style="text-align: left;font-family: sans-serif;">{{ $bloc->reference }} du {{ $bloc->pub_date->formatLocalized('%d %B %Y') }}</h3>
                        <p class="abstract">{{ $bloc->abstract }}</p>
                        <div>{{ $bloc->pub_text }}</div>
                        <p><a href="{{ asset('files/arrets/'.$bloc->file) }}">Télécharger en pdf</a></p>
                    </td>
                    <td width="25" height="100%" class="resetMarge" valign="top"></td><!-- space -->
                    <td align="center" valign="top" width="160" class="resetMarge">

                       <?php
                       if(!$bloc->arrets_categories->isEmpty() )
                       {
                           echo '<table border="0" width="160" align="center" cellpadding="0" cellspacing="0">';
                           foreach($bloc->arrets_categories as $categorie)
                           {
                               echo '<tr align="center" style="margin: 0;padding: 0;"><td style="margin: 0;padding: 0;page-break-before: always;"  valign="top">';
                               // Categories
                               echo '<a target="_blank" href="'.url('jurisprudence').'#'.$bloc->reference.'" style="margin:0;padding:0;display: block;">
                                        <img width="130" height="158" style="margin:0;padding:0;display: block;" border="0" alt="'.$categorie->title.'" src="'.asset('newsletter/pictos/'.$categorie->image).'">
                                      </a>';

                               echo '</td></tr>';
                           }
                           echo '</table>';
                        }
                        ?>

                    </td>
                </tr>
            </table>
            <!-- Bloc content-->
        </td>
    </tr>
    <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
</table>
<!-- End bloc -->

@if(isset($bloc->analyses))
    <!-- Bloc content-->
    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
        <tr bgcolor="ffffff">
            <td colspan="3" height="35"></td>
        </tr><!-- space -->
        <tr>
            <td valign="top" width="375" class="resetMarge contentForm">
                <?php $i = 1; ?>
                @foreach($bloc->analyses as $analyse)
                    <table border="0" width="375" align="left" cellpadding="0" cellspacing="0" class="resetTable">
                        <tr>
                            <td valign="top" width="375" class="resetMarge contentForm">
                                <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                                <h3 style="text-align: left;font-family: sans-serif;">Analyse de l'arrêt {{ $bloc->reference }}</h3>
                                <h4 style="text-align: left;font-family: sans-serif;">{{ $analyse->authors }}</h4>
                                <p class="abstract">{{ $analyse->abstract }}</p>
                                <p><a href="{{ asset('files/analyses/'.$analyse->file) }}">Télécharger en pdf</a></p>
                            </td>
                        </tr>

                        @if( $bloc->analyses->count() > 1 && $bloc->analyses->count() > $i)
                            <tr bgcolor="ffffff"><td colspan="3" height="35" class=""></td></tr><!-- space -->
                        @endif

                        <?php $i++; ?>
                    </table>
                @endforeach

            </td>
            <td width="25" class="resetMarge"></td><!-- space -->
            <td align="center" valign="top" width="160" class="resetMarge">
                <!-- Categories -->
                <div class="resetMarge">
                    <a target="_blank" href="{{ url('jurisprudence') }}">
                        <img width="130" border="0" alt="Analyse" src="{{ asset('images/analyse.png') }}">
                    </a>
                </div>
            </td>
        </tr>
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->
@endif