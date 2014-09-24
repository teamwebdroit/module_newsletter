<form flow-init flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
      flow-files-submitted="$flow.upload()"
      class="row" name="blocForm" class="form-horizontal">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>

                <td valign="top" align="center" width="100%" class="resetMarge">
                    <div class="upoadBtn">
                        <a href="#" class="btn btn-xs btn-info" ng-hide="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Selectionner image</a>
                        <a href="#" class="btn btn-xs btn-warning" ng-show="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Changer</a>
                        <a href="#" class="btn btn-xs btn-danger" ng-show="$flow.files.length" ng-click="$flow.cancel()">Supprimer</a>
                    </div>
                    <div class="thumbnail big" ng-hide="$flow.files.length"><img src="http://www.placehold.it/560x160/EFEFEF/AAAAAA&text=pas+d+image" /></div>
                    <div class="thumbnail big" ng-show="$flow.files.length"><img flow-img="$flow.files[0]" /></div>
                </td>
                
            </tr>

        </table>
        <!-- Bloc content-->
    </div>
</form>
