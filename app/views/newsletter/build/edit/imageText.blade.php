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
                    <img style="max-width: 560px;max-height: 150px;" alt="Droit du travail" src="{{ asset('files/'.$bloc->image) }}" />
                </div>
            </td>
        </tr>
        <tr><td colspan="3" height="25"></td></tr>
        <tr>
            <td valign="top" align="left" width="100%" class="resetMarge contentForm">
                <h2>{{ $bloc->titre }}</h2>
                <div>{{ $bloc->contenu }}</div>
            </td>
        </tr>
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->

    <div class="edit_content_form" id="edit_{{ $bloc->idItem }}">
        <form name="editForm">

            <div class="panel panel-orange">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" value="{{ $bloc->titre }}" required name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea required name="contenu" class="form-control redactor" rows="10">{{ $bloc->contenu }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="{{ $bloc->idItem }}" name="id">
                        <input type="hidden" id="editImage_{{ $bloc->idItem }}" name="image">
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
