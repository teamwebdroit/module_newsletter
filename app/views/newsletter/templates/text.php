<form class="row" name="blocForm" class="form-horizontal">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" align="left" width="100%" class="resetMarge contentForm">
                    <h2>{{ form.titre }}</h2>
                    <div ng-bind-html='form.content'></div>
                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Titre</label>
            <input type="text" ng-model="form.titre" name="titre" class="form-control">
        </div>
        <div class="form-group">
            <label>Texte</label>
            <textarea redactor ng-model="form.content" name="content" class="form-control" rows="10"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
