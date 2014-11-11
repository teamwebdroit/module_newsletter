var App = angular.module('newsletter', ["cgNotify","ngDragDrop","ngResource","angular-redactor","flow","ngSanitize","xeditable"] , function($interpolateProvider)
{
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

}).config(function(redactorOptions) {
        /* Redactor wysiwyg editor configuration */
        redactorOptions.minHeight = 150;
        redactorOptions.formattingTags = ['p', 'h2', 'h3','h4'];
}).config(['flowFactoryProvider', function (flowFactoryProvider) {
        /* Flow image upload configuration */
        flowFactoryProvider.defaults = {
            target: 'uploadJS',
            testChunks:false,
            singleFile: true,
            permanentErrors: [404, 500, 501],
            simultaneousUploads: 4
        };
}]).service('myService',  function ($rootScope) {
    var blocDrop = 0;
    return {
        getBloc : function() {
            return blocDrop;
        },
        setBloc : function(bloc) {
            blocDrop = bloc;
        },
        changes : function() {
            $rootScope.$broadcast('newsletter:updated');
        }
    };
});

/**
 * Build controller, controls all bloc for building the newsletter
 */
App.controller('BuildController', ['$scope','$http','Blocs','myService',function($scope,$http,Blocs,myService){

    /* assign empty values for blocs */
    this.blocs = [];
    /* capture this (the controller scope ) as self */
    var self = this;
    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Blocs.query()
            .then(function (data) {
                //console.log(data.blocs);
                self.blocs = data.blocs;
            })
    }
    this.refresh();

    this.clicked = function(bloc){
        myService.setBloc(bloc.template);
    };

    /* Test if the bloc is the one selected to create the correct template view */
    $scope.isBloc = function(bloc){
        return myService.getBloc() === bloc;
    };

}]);

/**
 * Build controller, controls all bloc for building the newsletter
 */
App.controller('ViewController', ['$scope','$http','Contents',function($scope,$http,Contents){

    var campagne    = $('#campagne_id').val();
    $scope.template = 'admin/campagne/view/' + campagne;


    /* assign empty values for blocs */
    this.contents = [];
    /* capture this (the controller scope ) as self */
    var self = this;
    /* function for refreshing the asynchronus retrival of contents */
    this.refresh = function() {
        Contents.query(campagne)
            .then(function (data) {
                console.log(data);
                self.contents = data;
            });
    }
    this.refresh();

    $scope.$on('newsletter:updated', function() {
        self.refresh();
    });

    $scope.isTemplate = function(template,content){
        return template === content;
    };

}]);

/**
 * Form controller, controls the form for creating new content blocs
 */
App.controller("FormController",['$scope','$http','notify','myService', function($scope,$http,notify,myService){

    $scope.addContent = function(form, type, id) {

        /* gather all date to send to the server */
        var image    = $('.uploadImage').val();
        var campagne = $('#campagne_id').val();

        notify.config({ duration: 1000 });

        var titre    = ( form.titre ? form.titre.$modelValue : '');
        var image    = ( image ? image : '');
        var contenu  = ( form.contenu ? form.contenu.$modelValue : '');
        var arret_id = (id ? id : 0);

        var data = { titre : titre , image : image , contenu: contenu , type: type , arret_id: arret_id , campagne: campagne };

        /* Send data */
        var all = $.param( data);

        $http({
            method : 'POST',
            url    : 'process',
            data   : all, // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
        })
        .success(function(data)
        {
            if (!data.success) {
                notify({
                    messageTemplate  : '<span>Le bloc a bien été ajouté</span>'
                });
                // remove arret template
                myService.setBloc(0);
                myService.changes();
            }
            else { notify({ messageTemplate:'Problème avec l\'édition du bloc'}); }
        });
    };
}]);

/**
 * Form controller, controls the form for creating new content blocs
 */
App.controller("EditController",['$scope','$http','notify','myService', function($scope,$http,notify,myService){

    $scope.editable = 0;

    this.onedit = function(id){
        return id == $scope.editable;
    };

    this.close = function(){
        $('.edit_content_form').hide();
    };

    this.editContent = function(idItem){

        var w = $( document ).width();
        w = w - 920;

        $scope.editable = idItem;
        console.log(idItem);
        console.log($scope.editable);

        $('.edit_content_form').hide();

        var content = $('#bloc_rang_'+idItem);
        content.find('.edit_content_form').css("width",w).show();
        $( "#sortable" ).sortable( "disable" );

    };

    this.updateContent = function(editForm,idItem){

        notify.config({ duration: 1000 });

        var image    = $('#editImage_'+ idItem ).val();
        var image    = ( image ? image : null);
        var titre    = ( editForm.titre ? editForm.titre.$modelValue : null);
        var contenu  = ( editForm.contenu ? editForm.contenu.$modelValue : null);

        var data = { titre : titre , image : image , contenu: contenu , id:idItem  };

        /* Send data */
        var all = $.param( data);

        $http({
            method : 'POST',
            url    : 'edit',
            data   : all, // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
        })
        .success(function(data)
        {
            if (!data.success) {
                notify({
                    messageTemplate  : '<span>Le bloc a bien été édité</span>'
                });
                myService.changes();
                $( "#sortable" ).sortable( "enable" );
                $scope.editable = 0;
            }
            else {  notify({ messageTemplate:'Problème avec l\'édition du bloc'}); }
        });

    }

}]);
/**
 * Select arret controller, select an arret and display's it
 */
App.controller('SelectController', ['$scope','$http','Arrets','notify','myService',function($scope,$http,Arrets,notify,myService){

    /* assign empty values for arrets */
    this.arrets = [];
    this.arret  = false;
    /* capture this (the controller scope ) as self */
    var self = this;

    notify.config({ duration: 1000 });

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Arrets.query()
            .then(function (data) {
                self.arrets = data;
            });
    }

    if(self.arrets.length == 0){
        this.refresh();
    }

    /* When one arret is selected in the dropdown */
    this.changed = function(){

        /* hide arret */
        self.arret      = false;
        self.categories = false;
        self.date       = new Date();

        /* Get the id of arret */
        var id = $scope.selected.id

        /* Get the selected arret infos */
        Arrets.simple(id)
            .then(function (data) {
                self.arret = data;
                self.categories = data.arrets_categories;

                //get substring
                var jsonObject = self.arret.pub_date.substr(0,10);
                var newdate    = new Date(jsonObject);
                self.date      = self.convertDate(newdate)
            });
    };

    this.convertDate = function(date){

        var months  = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
        var newdate = date.getDate();
        if (newdate < 10)
        {
            newdate = "0" + newdate;
        }
        var output = newdate + " " + months[date.getMonth()] + " " + date.getFullYear();
        return output;
    };

    $scope.addArret = function() {

        var arret_id = ( self.arret ? self.arret.id : 0);
        var campagne = $('#campagne_id').val();

        var data     = { type: 'arret' , arret_id: arret_id, campagne : campagne };
        /* Send data */
        var all = $.param( data);

        $http({
            method : 'POST',
            url    : 'process',
            data   : all, // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
        })
        .success(function(data)
        {
            if (!data.success) {
                notify('L\'arrêt a bien été ajouté');
                // remove arret template
                myService.setBloc(0);
                myService.changes();
            }
            else { notify('Problème avec l\'ajout du bloc'); }
        });
    };

}]);