<!-- Bloc -->
<table border="0" width="600" align="center" cellpadding="0" cellspacing="0" style="<?php echo $tableReset; ?>">
    <tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr><!-- space -->
    <tr align="center" class="resetMarge">
        <td class="resetMarge">

            <!-- Bloc content-->
            <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="tableReset">
                <tr>
                    <td valign="top" width="375" class="resetMarge">
                        <h2>{{ $bloc->titre }}</h2>
                        <div>{{ $bloc->contenu }}</div>
                    </td>
                    <td width="25" class="resetMarge"></td><!-- space -->
                    <td align="center" valign="top" width="160" class="resetMarge">

                        <!-- Categories -->
                        <a href="#"><img width="140" height="107" border="0" alt="Loyer" src="{{ asset('newsletter/loyer.jpg') }}"></a>
                        <p>Loyer</p>

                    </td>
                </tr>
            </table>
            <!-- Bloc content-->

        </td>
    </tr>
    <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
</table>
<!-- End bloc -->