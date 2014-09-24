<form class="row" name="arretForm" class="form-horizontal" ng-controller="SelectController as select">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" width="375" class="resetMarge contentForm">
                    <div ng-show="select.arret">
                        <h3>{{ select.arret.reference }} du {{ select.date | date: 'fullDate' }}</h3>
                        <p class="abstract">{{ select.arret.abstract }}</p>
                        <div class="content" ng-bind-html='select.arret.pub_text'></div>
                    </div>
                </td>
                <td width="25" class="resetMarge"></td><!-- space -->
                <td align="center" valign="top" width="160" class="resetMarge">

                    <!-- Categories -->
                    <div class="resetMarge" ng-repeat="categorie in select.categories">
                        <a href="#"><img width="140" height="107" border="0" alt="{{ categorie.title }}" src="<?php echo asset('newsletter/pictos/{{ categorie.image }}') ?>"></a>
                        <p class="middle">{{ categorie.title }}</p>
                    </div>

                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Sélectionner l'arrêt</label>

            <select class="form-control" ng-change="select.changed()" ng-model="selected" ng-options="arret.reference for arret in select.arrets track by arret.id">
                <option value="">Choisir</option>
            </select>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
