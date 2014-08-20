@extends('newsletter.layouts.bail')
@section('content')

<?php

    $header     = 'color: #ffffff; font-size: 18px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;';
    $titleRed   = 'font-family: Arial, Helvetica,sans-serif;font-size:13px;font-weight:bold;color:#CB2629;margin: 0 0 10px 0;padding: 0 0 0 0;';
    $paragraph  = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#303030;margin:0 0 10px 0;padding:0;';
    $soustitre  = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;font-style:italic;color:#666;margin:0 0 10px 0;padding:0 0 0 0;';
    $listItem   = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#1c1c1b;';
    $tableReset = 'border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;margin: 0;padding: 0;';

?>

<!-- HEADER -->
<!---------   top header   ------------>
<table border="0" width="600" cellpadding="0" cellspacing="0" align="center" class="container">

    <tr>
        <td align="center">
            <table border="0" width="600" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>

                        <!-- Logos and header img -->
                        <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr style="margin: 0;padding: 0;display:block;">
                                <td height="100" style="margin: 0;padding: 0;display:block;">
                                    <img width="100%" alt="Droit du bail" src="{{ asset('newsletter/logos-bail.jpg') }}"
                                </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;display:block;">
                                <td height="130" style="margin: 0;padding: 0;display:block;">
                                    <img height="130" alt="Droit du bail" src="{{ asset('newsletter/header-bail.jpg') }}" />
                                </td>
                            </tr>
                        </table>
                        <!-- End logos and header img -->

                        <!-- Title -->
                        <table width="600" bgcolor="#cb2629" border="0" cellpadding="0" cellspacing="0" align="center" style="<?php echo $tableReset; ?>">
                            <tr bgcolor="cb2629"><td colspan="3" height="10"></td></tr><!-- space -->
                            <tr>
                                <td width="15"></td>
                                <td align="left"><h1 style="<?php echo $header; ?>font-size: 18px;">Newsletter - Août 2014</h1></td>
                                <td width="15"></td>
                            </tr>
                            <tr><td height="3"></td></tr><!-- space -->
                            <tr>
                                <td width="15"></td>
                                <td align="left"><h2 style="<?php echo $header; ?>font-size:15px;">Editée par Bohnet F., Broquet J., Carron B., Montini M.</h2></td>
                                <td width="15"></td>
                            </tr>
                            <tr bgcolor="cb2629"><td colspan="3" height="10"></td></tr><!-- space -->
                            <tr bgcolor="ffffff"><td colspan="3" height="10"></td></tr><!-- space -->
                        </table>
                        <!-- End title -->

                        <!-- Bloc -->
                        <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                            <tr align="center" style="margin: 0;padding: 0;">
                                <td style="margin: 0;padding: 0;">
                                    <!-- Bloc content-->
                                    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                                        <tr>
                                            <td valign="top" width="370"  style="margin: 0;padding: 0;">
                                                <h2 style="<?php echo $titleRed; ?>">Droit du bail - Fond et procédure</h2>
                                                <p style="<?php echo $paragraph; ?>">
                                                    La Suisse est un pays de locataires. L’évolution de la société tend vers une multiplication des familles.
                                                    Une utilisation toujours plus mesurée du sol et des contraintes administratives strictes s’additionnent pour
                                                    péjorer l’offre de logements. D’où une situation tendue entre bailleurs et locataires. Cet abrégé se veut
                                                    une étude illustrative de ce droit social qu’est devenu le droit du bail. Il consacre une large place
                                                    à la jurisprudence, laquelle est abondante. L’accent est également mis sur l’aspect procédural, indissociable
                                                    d’une juste application du droit matériel. Contenu limité à l’étude des baux commerciaux et d’habitations,
                                                    l’ouvrage traite de la relation bailleur-locataire dès le début du bail jusqu’à son extinction.</p>
                                                <p style="<?php echo $paragraph; ?>">
                                                    Sont ainsi abordées notamment les questions touchant la conclusion du contrat, la pluralité de locataires,
                                                    l’entretien et les défauts de la chose louée, la consignation des loyers, les frais accessoires,
                                                    la sous-location et le transfert de bail, la restitution de la chose louée et son aliénation, la problématique
                                                    complexe de la fixation des loyers et des congés. Enfin, l’ouvrage aurait été incomplet s’il n’avait pas
                                                    tenu compte des règles procédurales spécifiques en la matière.</p>
                                                <p style="<?php echo $paragraph; ?>">Vous pouvez commander cet abrégé en
                                                    <a style="text-decoration:underline;<?php echo $paragraph; ?>" href="#" target="_blank">cliquant ici</a>.
                                                </p>
                                            </td>
                                            <td width="30" style="margin: 0;padding: 0;"></td><!-- space -->
                                            <td valign="top" width="160" style="margin: 0;padding: 0;">
                                                <img height="222" alt="Droit du bail" src="{{ asset('newsletter/holder.jpg') }}" />
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Bloc content-->
                                </td>
                            </tr>
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                        </table>
                        <!-- End bloc -->

                        <!-- Bloc -->
                        <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                            <tr align="center" style="margin: 0;padding: 0;">
                                <td style="margin: 0;padding: 0;">
                                    <!-- Bloc content-->
                                    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                                        <tr>
                                            <td valign="top" width="370"  style="margin: 0;padding: 0;">
                                                <h2 style="<?php echo $titleRed; ?>">18e Séminaire sur le droit du bail</h2>
                                                <h2 style="<?php echo $titleRed; ?>">L'incontournable colloque du domaine aura lieu cet automne à Neuchâtel !</h2>
                                                <p style="<?php echo $paragraph; ?>">
                                                    Des thèmes d'actualité feront l'objet d'une analyse détaillée par des spécialistes du droit du bail :</p>
                                                <ul>
                                                    <li style="<?php echo $listItem; ?>"><strong>Prof. Blaise Carron et Me Placidus Plattner</strong></li>
                                                    <li style="<?php echo $listItem; ?>font-style:italic;">La réparation du préjudice subi par le locataire en cas de défaut de la chose louée</li>
                                                    <li style="<?php echo $listItem; ?>"><strong>Prof. Laurent Bieri</strong></li>
                                                    <li style="<?php echo $listItem; ?>font-style:italic;">La réparation du préjudice subi par le locataire en cas de défaut de la chose louée</li>
                                                </ul>
                                                <p style="<?php echo $paragraph; ?>">
                                                    <strong>Deux éditions identiques auront lieu à l'Aula des Jeunes-Rives à Neuchâtel</strong>
                                                </p>
                                            </td>
                                            <td width="30" style="margin: 0;padding: 0;"></td><!-- space -->
                                            <td valign="top" width="160" style="margin: 0;padding: 0;">
                                                <img height="222" alt="Droit du bail" src="{{ asset('newsletter/holder2.jpg') }}" />
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Bloc content-->
                                </td>
                            </tr>
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                        </table>
                        <!-- End bloc -->

                        <!-- Bloc -->
                        <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                            <tr align="center" style="margin: 0;padding: 0;">
                                <td style="margin: 0;padding: 0;">

                                    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                                        <tr>
                                            <td valign="top" width="370"  style="margin: 0;padding: 0;">
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
                                                    <a style="text-decoration:underline;<?php echo $paragraph; ?>" href="fileadmin/media/images/Arrets_bail/2014_Newsletter_Aout/1_14_aout_4A_565_2013.pdf">Télécharger en PDF</a>
                                            </td>
                                            <td width="30" style="margin: 0;padding: 0;"></td><!-- space -->
                                            <td align="center" valign="top" width="160" style="margin: 0;padding: 0;">
                                                <div>
                                                    <a href="#"><img width="140" height="107" border="0" alt="Loyer" src="{{ asset('newsletter/loyer.jpg') }}"></a>
                                                    <p style="<?php echo $paragraph; ?>text-align: center;">Loyer</p>
                                                    <p style="height: 5px;display: block;"></p>
                                                </div>
                                                <div>
                                                    <a href="#"><img width="140" height="107" border="0" alt="Destiné à la publication" src="{{ asset('newsletter/publication.jpg') }}"></a>
                                                    <p style="<?php echo $paragraph; ?>text-align: center;">Destiné à la publication</p>
                                                    <p style="height: 5px;display: block;"></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr bgcolor="ffffff"><td colspan="3" height="15"></td></tr><!-- space -->
                        </table>
                        <!-- End bloc -->

                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr bgcolor="e9e9e9"><td height="10"></td></tr>

</table>
<!-- END HEADER -->

@stop