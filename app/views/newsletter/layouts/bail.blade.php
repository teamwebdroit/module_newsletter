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

    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

        <!-- Main table -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <!-- Main content wrapper -->
            <tr>
                <td width="100%" align="center" valign="top">

                    <!-- See in browser -->
                    <table border="0" width="600" cellpadding="0" cellspacing="0" style="{{ $tableReset }}">
                        <tr><td height="15"></td></tr><!-- space -->
                        <tr>
                            <td align="center" style="{{ $linkGrey }}">
                                Si cet email ne s'affiche pas correctement, vous pouvez le voir directement dans
                                <a style="{{ $linkGrey }}" href="{{ $browser }}">votre navigateur</a>.
                            </td>
                        </tr>
                        <tr><td height="15"></td></tr><!-- space -->
                    </table>
                    <!-- End see in browser -->

                    <!-- Logos and header img -->
                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="{{ $tableReset }}">
                        <tr style="{{ $resetMarge }}display:block;">
                            <td height="100" style="margin: 0;padding: 0;display:block;border: 1px solid #{{ $borderGray }}; border-bottom: 0;">
                                <a href="http://www.bail.ch"><img width="100%" alt="Droit du bail" src="{{ asset('newsletter/logos-bail.jpg') }}" /></a>
                            </td>
                        </tr>
                        <tr style="{{ $resetMarge }}display:block;">
                            <td height="130" style="{{ $resetMarge }}display:block;">
                                <img height="130" alt="Droit du bail" src="{{ asset('newsletter/header-bail.jpg') }}" />
                            </td>
                        </tr>
                    </table>
                    <!-- End logos and header img -->
                </td>
            </tr>
            <tr>
                <td width="100%" align="center" valign="top">
                    <!-- Main content -->
                    @yield('content')
                    <!-- Fin contenu -->
                </td>
            </tr>
            <tr>
                <td width="100%" align="center" valign="top">
                    <!-- See in browser -->
                    <table border="0" width="600" cellpadding="0" cellspacing="0" style="{{ $tableReset }}">
                        <tr><td height="15"></td></tr><!-- space -->
                        <tr>
                            <td align="center"  style="{{ $linkGrey }}">
                                Si vous ne désirez plus recevoir cette newsletter, vous pouvez vous désinscrire à tout moment en
                                <a style="{{ $linkGrey }}" href="{{ $unsuscribe }}">cliquant ici</a>.
                            </td>
                        </tr>
                        <tr><td height="15"></td></tr><!-- space bottom -->
                    </table>
                    <!-- End see in browser -->
                </td>
            </tr>
            <!-- End main content wrapper -->
        </table>
        <!-- End main table -->

    </body>

</html>