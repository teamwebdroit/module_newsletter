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
                    <td align="center" valign="top" width="560" class="resetMarge">
                        <p class="centerText">
                            <a href="#">
                                <img style="max-width: 560px;max-height: 120px;" alt="Droit du travail" src="{{ asset('files/'.$bloc->image) }}" />
                            </a>
                        </p>
                        @if( $bloc->titre )
                            <h2>{{ $bloc->titre }}</h2>
                        @endif
                    </td>
                </tr>
            </table>
            <!-- Bloc content-->
        </td>
    </tr>
    <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
</table>
<!-- End bloc -->

