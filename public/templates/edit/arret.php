<div class="edit_content" ng-controller="EditController as edit">

    <!-- Bloc content-->
    <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
        <tr bgcolor="ffffff">
            <td colspan="3" height="35">
                <div class="pull-right btn-group btn-group-xs">
                    <button class="btn btn-danger deleteContent deleteContentBloc" data-id="{[{ content.idItem }]}" data-action="{[{ content.reference }]}" type="button">&nbsp;×&nbsp;</button>
                </div>
            </td>
        </tr><!-- space -->
        <tr>
            <td valign="top" width="375" class="resetMarge contentForm">
                <div>
                    <h3>{[{ content.reference }]} <span ng-show="content.reference">du</span> {[{ content.dateRef }]}</h3>
                    <p class="abstract" ng-bind-html='content.abstract'></p>
                    <div class="content" ng-bind-html='content.pub_text'></div>
                </div>
            </td>
            <td width="25" class="resetMarge"></td><!-- space -->
            <td align="center" valign="top" width="160" class="resetMarge">
                <!-- Categories -->
                <div class="resetMarge" ng-repeat="categorie in content.arrets_categories">
                    <a href="#">
                        <img ng-show="categorie.image" width="130" border="0" alt="{[{ categorie.title }]}" ng-src="<?php echo asset('newsletter/pictos/{[{ categorie.image }]}') ?>">
                    </a>
                </div>
            </td>
        </tr>
        <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- Bloc content-->

</div>
