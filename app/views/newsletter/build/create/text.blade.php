<div class="create_content" ng-controller="CreateController as create">

    <div class="col-md-7" id="bailNewsletterCreate">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" align="left" width="100%" class="resetMarge contentForm">
                    <h2 ng-bind="create.titre"></h2>
                    <div ng-bind-html="create.contenu"></div>
                </td>
            </tr>
            <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
        </table>
    </div>
    <div class="col-md-5 create_content_form">
    <!-- Bloc content-->
        <form name="createForm" method="post" action="{{ url('process') }}">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input bind-content ng-model="create.titre" type="text" value="" required name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Texte</label>
                        <textarea bind-content redactor ng-model="create.contenu" required name="contenu" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="{{ $bloc->type_id }}" name="type">
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
