<div class="edit_content">

    <!-- Bloc content-->
    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
        <tr bgcolor="ffffff">
            <td colspan="3" height="35">
                <div class="pull-right btn-group btn-group-xs">
                    <button class="btn btn-orange editContent" data-id="{{ $bloc->idItem }}" type="button">éditer</button>
                    <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{{ $bloc->idItem }}" data-action="{{ $bloc->titre }}" type="button">&nbsp;×&nbsp;</button>
                </div>
            </td>
        </tr><!-- space -->
        <tr>
            <td valign="top" align="center" width="100%" class="resetMarge">
                <div class="thumbnail big">
                    <a href="#">
                        <img style="max-width: 560px;" alt="Droit du travail" src="{{ asset('files/'.$bloc->image) }}" />
                    </a>
                </div>
            </td>
        </tr>
        <tr bgcolor="ffffff">
            <td align="center" valign="top" width="560" class="resetMarge">
                @if( $bloc->titre )
                    <h2 class="centerText">{{ $bloc->titre }}</h2>
                @endif
            </td>
        </tr><!-- space -->
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->

    <div class="edit_content_form" id="edit_{{ $bloc->idItem }}">
        <form name="editForm">
            <div class="panel panel-orange">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" name="titre" value="{{ $bloc->titre }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="{{ $bloc->type_id }}" name="type">
                        <input type="hidden" value="{{ $bloc->idItem }}" name="id">
                        <input type="file" id="editImage_{{ $bloc->idItem }}" name="image" value="">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-sm btn-orange">Envoyer</button>
                            <button type="button" class="btn btn-sm btn-default cancelEdit">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
