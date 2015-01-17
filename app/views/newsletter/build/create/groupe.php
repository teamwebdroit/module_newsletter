<form ng-controller="SimpleDemoController" class="row form-horizontal" name="arretForm" method="post" action="<?php echo url('process'); ?>">
    <?php echo Form::token(); ?>

    <div class="col-md-7" id="bailNewsletterCreate">

        <!-- Bloc content-->
        <table ng-repeat="arret in models.lists.B track by $index" border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr><!-- space -->
            <tr>
                <td valign="top" width="375" class="resetMarge contentForm">
                    <div>
                        <h3>{[{ arret.reference }]} <span ng-show="arret.reference">du</span> {[{ arret.itemDate | date: 'fullDate' }]}</h3>
                        <p class="abstract">{[{ arret.abstract }]}</p>
                        <div class="content" ng-bind-html='arret.pub_text'></div>
                    </div>
                </td>
                <td width="25" class="resetMarge"></td><!-- space -->
                <td align="center" valign="top" width="160" class="resetMarge">
                    <!-- Categories -->
                    <div class="resetMarge" ng-repeat="categorie in arret.categories">
                        <a target="_blank" href="#">
                            <img ng-show="categorie.image" width="130" border="0" alt="{[{ categorie.title }]}" ng-src="<?php echo asset('newsletter/pictos/{[{ categorie.image }]}') ?>">
                        </a>
                    </div>
                </td>
            </tr>
            <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
        </table>
        <!-- Bloc content-->

    </div>
    <div class="col-md-5 create_content_form">
        <div class="panel panel-success">
            <div class="panel-body">

                <div class="form-group">
                    <label for="categories" class="control-label">Catégorie</label>
                    <div class="row">
                        <div class="col-sm-8">
                            <select name="categorie_id" class="form-control">
                                <?php
                                if(!empty($allcategories))
                                {
                                    foreach($allcategories as $idcat => $categorie)
                                    {
                                        echo '<option value="'.$idcat.'">'.$categorie.'</li>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sélectionner des arrêts</label>

                    <div class="listArrets">
                        <div ng-repeat="(listName, list) in models.lists">
                            <ul class="list-arrets" dnd-list="list">
                                <li ng-repeat="item in list"
                                    dnd-draggable="item"
                                    dnd-moved="list.splice($index, 1); logEvent('Container moved', event); dropped(item)"
                                    dnd-effect-allowed="move"
                                    dnd-selected="models.selected = item"
                                    ng-class="{'selected': models.selected === item}" >
                                    {[{item.reference}]}
                                    <input type="hidden" name="arrets[]" ng-if="item.isSelected" value="{[{ item.itemId }]}" />
                                </li>
                            </ul>
                        </div>
                        <div view-source="simple"></div>

                    </div>

                </div>
                <div class="form-group">
                    <div class="btn-group">
                        <input type="hidden" value="<?php echo $bloc->id; ?>" name="type_id">
                        <input type="hidden" value="<?php echo $infos->id; ?>" name="campagne">
                        <button type="submit" class="btn btn-sm btn-success">Envoyer</button>
                        <button type="button" class="btn btn-sm btn-default cancelCreate">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>