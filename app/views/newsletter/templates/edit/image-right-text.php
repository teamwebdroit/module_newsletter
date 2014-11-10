<div class="edit_content" ng-controller="EditController as edit"
     flow-init
     flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
     flow-complete="netedited = true"
     flow-files-submitted="$flow.upload()">

    <!-- Bloc content-->
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
            <td valign="top" width="375" class="resetMarge contentForm">
                <h2>{{ content.titre }}</h2>
                <div ng-bind-html='content.contenu'></div>
            </td>
            <td width="25" class="resetMarge"></td><!-- space -->
            <td valign="top" align="center" width="160" class="resetMarge">
                <div class="uploadBtn" ng-if="!notedited">
                    <span class="btn btn-xs btn-info" ng-if="edit.onedit( content.idItem )" flow-btn flow-attrs="{accept:'image/*'}">Changer image</span>
                    <span class="btn btn-xs btn-warning" ng-show="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Changer</span>
                    <span class="btn btn-xs btn-danger" ng-show="$flow.files.length" ng-click="$flow.cancel()">Supprimer</span>
                </div>
                <div class="thumbnail big" ng-hide="$flow.files.length">
                    <img flow-img="$flow.files[0]" ng-if="notedited"/>
                    <img ng-src="<?php echo url('files'); ?>/{[{content.image}]}" ng-if="!notedited"/>
                </div>
                <div class="thumbnail big" ng-show="$flow.files.length"><img flow-img="$flow.files[0]" /></div>
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
                        <input type="hidden" id="editImage_{[{ content.idItem }]}" ng-model="content.image" id="editImage_{[{ content.idItem }]}" name="image" value="{{ $flow.files[0].name }}">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Envoyer</button>
                            <button type="submit" class="btn btn-default">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>
