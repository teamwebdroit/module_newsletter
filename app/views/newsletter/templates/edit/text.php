<div class="edit_content" ng-controller="EditController as edit">

    <!-- Bloc content-->
    <h2>{{ edit.titre }}</h2>
    <div ng-bind-html='edit.contenu'></div>
    <!-- Bloc content-->

    <div class="edit_content_form">
        <form name="editForm" class="form-horizontal" ng-submit="editContent(editForm,'text')">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" ng-model="edit.titre" required name="titre" class="form-control">
            </div>
            <div class="form-group">
                <label>Texte</label>
                <textarea redactor ng-model="edit.contenu" required name="contenu" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" ng-model="edit.id" name="id">
                <button type="submit" class="btn btn-default">Envoyer</button>
            </div>
        </form>
    </div>

</div>