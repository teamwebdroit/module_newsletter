<!-- Bloc -->
<table id="bloc_rang_{{ $bloc->idItem }}" data-rel="{{ $bloc->rangItem }}" border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="tableReset">
    <tr bgcolor="ffffff">
        <td colspan="3" height="35">
            <div class="pull-right btn-group btn-group-xs">
                <button class="btn btn-orange" type="button">éditer</button>
                <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{{ $bloc->idItem }}" data-action="{{ $bloc->reference }}" type="button">&nbsp;×&nbsp;</button>
            </div>
        </td>
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
                        <h2>{{ $bloc->titre }}</h2>
                    </td>
                </tr>
            </table>
            <!-- Bloc content-->
        </td>
    </tr>
    <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
</table>
<!-- End bloc -->

