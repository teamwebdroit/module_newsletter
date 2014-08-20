<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- Define Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Responsive Meta Tag -->
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <title>Séminaire sur le droit du bail</title><!-- Responsive Styles and Valid Styles -->

        <style type="text/css">

            body{
                width: 100%;
                background-color: #ffffff;
                margin:0;
                padding:0;
                -webkit-font-smoothing: antialiased;
            }
            p,h1,h2,h3,h4{
                margin-top:0;
                margin-bottom:0;
                padding-top:0;
                padding-bottom:0;
            }
            html{
                width: 100%;
            }

            table{
                font-size: 14px;
                border: 0;
                padding: 0;
                margin: 0;
            }

            /* ----------- responsivity ----------- */
            @media only screen and (max-width: 640px){
            }

            @media only screen and (max-width: 479px){
            }

        </style>
    </head>

    <?php
        $tableReset = 'border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;margin: 0;padding: 0;';
    ?>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <!-- Main table -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr><td height="10"></td></tr><!-- space top -->
            <!-- Main content wrapper -->
            <tr>
                <td width="100%" align="center" valign="top">
                    <!-- See in browser -->
                    <table border="0" width="600" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
                        <tr>
                            <td align="center">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="color: #999; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                            Si cet email ne s'affiche pas correctement, vous pouvez le voir directement dans
                                            <a style="color: #999; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;" href="#">votre navigateur</a>.
                                        </td>
                                    </tr>
                                    <tr><td height="10"></td></tr><!-- space -->
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- End see in browser -->

                    <!-- Main content -->
                    @yield('content')
                    <!-- Fin contenu -->

                </td>
            </tr>
            <!-- End main content wrapper -->
            <tr><td height="30"></td></tr><!-- space bottom -->
        </table>
    <!-- End main table -->

    </body>

</html>