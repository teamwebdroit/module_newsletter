<form class="row" name="arretForm" class="form-horizontal" ng-controller="SelectController as select">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" align="left" width="100%" class="resetMarge contentForm">

                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Sélectionner l'arrêt</label>
            <select class="form-control" ng-model="selected" ng-change="select.changed()">
                <option ng-repeat="arret in select.arrets" value="{{ arret.id }}">{{ arret.reference }}</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
