<form action="" method="post" name="blocForm" class="form-horizontal">

    <h2>{{ form.title }}</h2>
    <div ng-bind-html='form.content'></div>

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
</form>