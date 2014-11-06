<div id="bloc_rang_{[{ content.idItem }]}" class="edit_content" ng-controller="EditController as edit"
     flow-init flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
     flow-files-submitted="$flow.upload(),netedited = true">

    <!-- Bloc content-->
    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
        <tr bgcolor="ffffff">
            <td colspan="3" height="35">
                <div class="pull-right btn-group btn-group-xs">
                    <button class="btn btn-orange" type="button">éditer</button>
                    <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{[{ content.idItem }]}" data-action="{[{ content.titre }]}" type="button">&nbsp;×&nbsp;</button>
                </div>
            </td>
        </tr><!-- space -->
        <tr>
            <td valign="top" align="center" width="100%" class="resetMarge">
                <div class="uploadBtn" ng-if="!notedited">
                    <span class="btn btn-xs btn-info" ng-hide="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Selectionner image</span>
                    <span class="btn btn-xs btn-warning" ng-show="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Changer</span>
                    <span class="btn btn-xs btn-danger" ng-show="$flow.files.length" ng-click="$flow.cancel()">Supprimer</span>
                </div>
                <div class="thumbnail big" ng-hide="$flow.files.length">
                    <img flow-img="$flow.files[0]" ng-if="notedited"/>
                    <img ng-src="<?php echo url('files'); ?>/{{content.image}}" ng-if="!notedited"/>
                </div>
                <div class="thumbnail big" ng-show="$flow.files.length"><img flow-img="$flow.files[0]" /></div>
            </td>
        </tr>
        <tr><td colspan="3" height="25"></td></tr>
        <tr>
            <td valign="top" align="center" width="100%" class="resetMarge contentForm">
                <h2>{[{ content.titre }]}</h2>
            </td>
        </tr>
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->

    <div class="edit_content_form">
        <form name="editForm" class="form-horizontal" ng-submit="editContent(editForm,'image')">

            <div class="panel panel-success">
                <div class="panel-heading">Texte et image</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" ng-model="edit.titre" name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" ng-model="edit.id" name="id">
                        <input type="hidden" class="uploadImage" name="image" ng-if="notedited" value="{{ $flow.files[0].name }}">
                        <button type="submit" class="btn btn-default">Envoyer</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>
