<form flow-init flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
      flow-files-submitted="$flow.upload()"
      class="row" name="blocForm" class="form-horizontal"
      ng-controller="FormController as formCtrl"
      ng-submit="addContent(blocForm,'text')">

    <div class="col-md-7" id="bailNewsletterCreate">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" align="left" width="100%" class="resetMarge contentForm">
                    <h2>{{ formCtrl.form.titre }}</h2>
                    <div ng-bind-html='formCtrl.form.contenu'></div>
                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">

        <div class="panel panel-success">
            <div class="panel-heading">Titre et texte</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" ng-model="formCtrl.form.titre" required name="titre" class="form-control">
                </div>
                <div class="form-group">
                    <label>Texte</label>
                    <textarea redactor ng-model="formCtrl.form.contenu" required name="contenu" class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </div>
            </div>
        </div>

    </div>
</form>
