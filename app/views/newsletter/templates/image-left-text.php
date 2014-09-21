<form flow-init flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
      flow-files-submitted="$flow.upload()"
      class="row" name="blocForm" class="form-horizontal" ng-controller="FormController as formCtrl" ng-submit="addContent(blocForm)">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>

                <td valign="top" align="center" width="160" class="resetMarge">

                    <div class="thumbnail" ng-hide="$flow.files.length"><img src="http://www.placehold.it/130x140/EFEFEF/AAAAAA&text=no+image" /></div>
                    <div class="thumbnail" ng-show="$flow.files.length"><img flow-img="$flow.files[0]" /></div>

                    <input type="hidden" ng-model="formCtrl.form.image" name="image" value="$flow.files[0].name">

                    <div class="upoadBtn">
                        <a href="#" class="btn btn-xs btn-info" ng-hide="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Selectionner image</a>
                        <a href="#" class="btn btn-xs btn-warning" ng-show="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Changer</a>
                        <a href="#" class="btn btn-xs btn-danger" ng-show="$flow.files.length" ng-click="$flow.cancel()">Supprimer</a>
                    </div>

                </td>
                <td width="25" class="resetMarge"></td><!-- space -->
                <td valign="top" width="375" class="resetMarge contentForm">
                    <h2>{{ formCtrl.form.title }}</h2>
                    <div ng-bind-html='formCtrl.form.content'></div>
                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Titre</label>
            <input type="text" ng-model="formCtrl.form.title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Texte</label>
            <textarea redactor ng-model="formCtrl.form.content" name="content" class="form-control" rows="10"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
