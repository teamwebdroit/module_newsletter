var App = angular.module('createApp', ["cgNotify","ngResource","angular-redactor","ngSanitize"] , function($interpolateProvider)
{
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

}).service('myService',  function ($rootScope) {
    var blocDrop = 0;
    return {
        getBloc : function() {
            return blocDrop;
        },
        setBloc : function(bloc) {
            $('.edit_content_form').hide();
            blocDrop = bloc;
        },
        changes : function() {
            $rootScope.$broadcast('newsletter:updated');
        }
    };
});

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

    this.close = function(){
        myService.setBloc(0);
        $('.edit_content_form').hide();
    };

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
/**
 * Build controller, controls all bloc for building the newsletter
 */
App.controller('CreateController', ['$scope','$http',function($scope,$http){

    this.titre = '';
    this.contenu = '';

}]);
