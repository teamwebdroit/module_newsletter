<div class="edit_content" ng-controller="EditController as edit">

    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
        <tr bgcolor="ffffff">
            <td colspan="3" height="35">
                <div class="pull-right btn-group btn-group-xs">
                    <button class="btn btn-orange" ng-click="edit.editContent(content.idItem)" type="button">éditer</button>
                    <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{[{ content.idItem }]}" data-action="{[{ content.titre }]}" type="button">&nbsp;×&nbsp;</button>
                </div>
            </td>
        </tr><!-- space -->
        <tr>
            <td valign="top" align="left" width="100%" class="resetMarge contentForm">
                <h2>{[{ content.titre }]}</h2>
                <div ng-bind-html='content.contenu'></div>
            </td>
        </tr>
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->

    <div class="edit_content_form">
        <form name="editForm" class="form-horizontal" ng-submit="edit.updateContent(editForm,content.idItem)">

            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" ng-model="content.titre" required name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea redactor ng-model="content.contenu" required name="contenu" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" ng-model="content.idItem" name="id">
                        <input type="hidden" class="uploadImage" name="image" ng-if="notedited" value="{{ $flow.files[0].name }}">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Envoyer</button>
                            <button type="button" ng-click="edit.close()" class="btn btn-default">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>