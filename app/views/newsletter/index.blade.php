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
        <td style="border-left: 1px solid #{{ $borderGray }};border-right: 1px solid #{{ $borderGray }};">

                <!-- Text title center -->
                @include('newsletter.content.textTitle')

                <!-- Image Right title  -->
                @include('newsletter.content.titleImageRight')

                <!-- Image center  -->
                @include('newsletter.content.imageCenter')

                <!-- Image Right Text Bloc  -->
                @include('newsletter.content.imageLeftTextBloc')

                <!-- Image Right Text Bloc  -->
                @include('newsletter.content.imageRightTextBloc')

                <!-- Arret Image Right Text Bloc  -->
                @include('newsletter.content.arretImageTextBloc')

        </td>
    </tr>
    <tr><td height="40" style="border-bottom: 1px solid #{{ $borderGray }};border-right: 1px solid #{{ $borderGray }};border-left: 1px solid #{{ $borderGray }};"></td></tr><!-- space and borders  -->

</table>
<!-- END HEADER -->

@stop