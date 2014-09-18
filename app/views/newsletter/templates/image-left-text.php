<form action="" method="post" class="row" name="blocForm" class="form-horizontal">
    <div class="col-md-7" id="bailNewsletter">
        <!-- Bloc content-->
        <table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="resetTable">
            <tr>
                <td valign="top" width="375" class="resetMarge">
                    <h2>{{ form.title }}</h2>
                    <div ng-bind-html='form.content'></div>
                </td>
                <td width="25" class="resetMarge"></td><!-- space -->
                <td valign="top" align="center" width="160" class="resetMarge bgCell">
                    <div flow-init="{target: '/upload/store'}" flow-files-submitted="$flow.upload()" flow-file-success="$file.msg = $message">

                        <input type="file" flow-btn/>
                        <input type="hidden" name="destination" value="files" />
                        <span class="btn" flow-btn>Upload File</span>

                        <table>
                            <tr ng-repeat="file in $flow.files">
                                <td>{{$index+1}}</td>
                                <td>{{file.name}}</td>
                                <td>{{file.msg}}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <!-- Bloc content-->
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label>Titre</label>
            <input type="text" ng-model="form.title" name="title" class="form-control">
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
