@extends('newsletter.layouts.bail')
@section('content')

<!-- HEADER -->
<!---------   top header   ------------>
<table border="0" width="600" cellpadding="0" cellspacing="0" align="center">

    <tr>
        <td align="center">

            <!-- Title -->
            <table width="600" bgcolor="<?php echo $redBail; ?>" border="0" cellpadding="0" cellspacing="0" align="center" style="<?php echo $tableReset; ?>">
                <tr bgcolor="<?php echo $redBail; ?>"><td colspan="3" height="10"></td></tr><!-- space -->
                <tr>
                    <td width="20"></td>
                    <td align="left"><h1 style="<?php echo $header; ?>font-size: 18px;">Newsletter - Août 2014</h1></td>
                    <td width="20"></td>
                </tr>
                <tr><td height="3"></td></tr><!-- space -->
                <tr>
                    <td width="20"></td>
                    <td align="left"><h2 style="<?php echo $header; ?>font-size:15px;">Editée par Bohnet F., Broquet J., Carron B., Montini M.</h2></td>
                    <td width="20"></td>
                </tr>
                <tr bgcolor="<?php echo $redBail; ?>"><td colspan="3" height="10"></td></tr><!-- space -->
            </table>
            <!-- End title -->

        </td>
    </tr>
    <tr>
        <td style="border-left: 1px solid #ededed; 	border-right: 1px solid #ededed;">

            <!-- Bloc -->
            <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                <?php  echo $blocSpacer; ?>
                <tr align="center" style="<?php echo $resetMarge; ?>">
                    <td style="<?php echo $resetMarge; ?>">

                        <!-- Image Right Text Bloc  -->
                        @include('newsletter.content.ImageRightTextBloc')

                    </td>
                </tr>
                <?php echo $blocSpacerBorder; ?><!-- space -->
            </table>
            <!-- End bloc -->

            <!-- Bloc -->
            <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                <?php  echo $blocSpacer; ?>
                <tr align="center" style="<?php echo $resetMarge; ?>">
                    <td style="<?php echo $resetMarge; ?>">

                        <!-- Bloc content-->
                        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr>
                                <td valign="top" width="375"  style="<?php echo $resetMarge; ?>">
                                    <h2 style="<?php echo $titleRed; ?>">18e Séminaire sur le droit du bail</h2>
                                    <h3 style="<?php echo $soustitleRed; ?>">L'incontournable colloque du domaine aura lieu cet automne à Neuchâtel !</h3>
                                    <p style="<?php echo $paragraph; ?>">
                                        Des thèmes d'actualité feront l'objet d'une analyse détaillée par des spécialistes du droit du bail :</p>
                                    <ul style="margin-left: 5px;padding-left: 15px;">
                                        <li style="<?php echo $listItem; ?>"><strong>Prof. Blaise Carron et Me Placidus Plattner</strong><br/>
                                            <i>La réparation du préjudice subi par le locataire en cas de défaut de la chose louée</i></li>
                                        <li style="<?php echo $listItem; ?>"><strong>Prof. Laurent Bieri</strong><br/>
                                            <i>La réparation du préjudice subi par le locataire en cas de défaut de la chose louée</i></li>
                                    </ul>
                                    <h4 style="<?php echo $paragraph; ?>text-align:justify;font-weight:bold;">Deux éditions identiques auront lieu à l'Aula des Jeunes-Rives à Neuchâtel</h4>
                                    <ul style="margin-left: 5px;padding-left: 15px;">
                                        <li style="<?php echo $listItem; ?>">
                                            <h2 style="<?php echo $soustitleRed; ?>">les 3 & 4 octobre 2014 pour la première édition</h2>
                                        </li>
                                        <li style="<?php echo $listItem; ?>"><h2 style="<?php echo $soustitleRed; ?>">les 17 & 18 octobre 2014 pour la deuxième édition</h2></li>
                                    </ul>
                                </td>
                                <td width="25" style="<?php echo $resetMarge; ?>"></td><!-- space -->
                                <td valign="top" align="center" width="160" style="<?php echo $resetMarge; ?>">
                                    <img height="222" alt="Droit du bail" src="{{ asset('newsletter/holder2.jpg') }}" />
                                </td>
                            </tr>
                        </table>
                        <!-- Bloc content-->

                    </td>
                </tr>
                <?php echo $blocSpacerBorder; ?><!-- space -->
            </table>
            <!-- End bloc -->

            <!-- Bloc -->
            <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                <?php  echo $blocSpacer; ?>
                <tr align="center" style="<?php echo $resetMarge; ?>">
                    <td style="<?php echo $resetMarge; ?>">

                        <!-- Bloc content-->
                        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr>
                                <td valign="top" width="375"  style="margin: 0;padding: 0;">
                                    <h2 style="<?php echo $titleRed; ?>">Arrêt du mois : TF 4A_565/2013 du 8 juillet 2014 </h2>
                                    <h4 style="<?php echo $soustitre; ?>">Loyer ; importantes réparations ; hausse de loyer ; notion d’immeuble ancien ;
                                        calcul de rendement net ; frais d’entretien ; art. 269, 269a let. a et b CO ; 14 OBLF</h4>
                                    <p style="<?php echo $paragraph; ?>">
                                        Notion d’<b>immeuble ancien</b>
                                        niée en l’espèce pour des immeubles construits en 1982 et 1983, à mesure que l’on peut raisonnablement exiger de la
                                        propriétaire-bailleresse la conservation des pièces justificatives compte tenu du fait qu’il s’agit d’une société
                                        d’assurance qui détient les immeubles concernés à titre professionnel (consid. 3.1).
                                    </p>
                                    <p style="<?php echo $paragraph; ?>">
                                        La prise en compte d’un taux d’intérêt de 1,75 % pour renter la part des
                                        <b>frais d’entretien extraordinairement élevés</b>
                                        non encore amortis n’est pas contraire au droit fédéral consacré par les art. 269 et 269a CO (consid. 3.5).
                                    </p>
                                    <a style="text-decoration:underline;<?php echo $paragraph; ?>" href="#">Télécharger en PDF</a>
                                </td>
                                <td width="25" style="<?php echo $resetMarge; ?>"></td><!-- space -->
                                <td align="center" valign="top" width="160" style="<?php echo $resetMarge; ?>">

                                    <!-- Categories -->
                                    <a href="#"><img width="140" height="107" border="0" alt="Loyer" src="{{ asset('newsletter/loyer.jpg') }}"></a>
                                    <p style="<?php echo $paragraph; ?>text-align: center;">Loyer</p>
                                    <p style="height: 5px;display: block;"></p>

                                </td>
                            </tr>
                        </table>
                        <!-- Bloc content-->

                    </td>
                </tr>
                <?php echo $blocSpacerBorder; ?><!-- space -->
            </table>
            <!-- End bloc -->

        </td>
    </tr>
    <tr><td height="40" style="border-bottom: 1px solid #<?php echo $borderGray; ?>;border-right: 1px solid #<?php echo $borderGray; ?>;border-left: 1px solid #<?php echo $borderGray; ?>;"></td></tr><!-- space and borders  -->

</table>
<!-- END HEADER -->

@stop