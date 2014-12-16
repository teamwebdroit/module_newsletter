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
            <td valign="top" width="375" class="resetMarge contentForm">
                <h2>{{ $bloc->titre }}</h2>
                <div>{{ $bloc->contenu }}</div>
            </td>
            <td width="25" class="resetMarge"></td><!-- space -->
            <td valign="top" align="center" width="160" class="resetMarge">
                <div class="thumbnail big">
                    <img src="<?php echo url('files'); ?>/{{ $bloc->image }}" />
                </div>
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
                        <input type="text" required name="titre" class="form-control" value="{{ $bloc->titre }}">
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea required name="contenu" class="form-control redactor" rows="10">{{ $bloc->contenu }}</textarea>
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
