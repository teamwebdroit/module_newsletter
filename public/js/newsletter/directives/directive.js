var Newsletter = angular.module('newsletter');

/**
 * Build directive, display all types of content
 */
Newsletter.directive("buildingBlocs", function() {
    return {
        restrict: "AEC",
        scope:true,
        templateUrl: "building-blocs"
    };
});


/* =========================
    Templates for creation
  ========================= */

Newsletter.directive("arret", function() {
    return {
        restrict: "AEC",
        templateUrl: "arret"
    };
});

Newsletter.directive("imageLeftText", function() {
    return {
        restrict: "AEC",
        scope   :{ngModel: '='},
        templateUrl: "image-left-text"
    };
});

Newsletter.directive("imageRightText", function() {
    return {
        restrict: "AEC",
        scope   :{ngModel: '='},
        templateUrl: "image-right-text"
    };
});

Newsletter.directive("imageText", function() {
    return {
        restrict: "AEC",
        scope   :{ngModel: '='},
        templateUrl: "image-text"
    };
});

Newsletter.directive("imageAlone", function() {
    return {
        restrict: "AEC",
        scope   :{ngModel: '='},
        templateUrl: "image"
    };
});

Newsletter.directive("textAlone", function() {
    return {
        restrict: "AEC",
        scope   :{ngModel: '='},
        templateUrl: "text"
    };
});

/* =========================
 Templates for edition
 ========================= */

Newsletter.directive("arretEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "arret-edit"
    };
});

Newsletter.directive("imageLeftTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-left-text-edit"
    };
});

Newsletter.directive("imageRightTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-right-text-edit"
    };
});

Newsletter.directive("imageTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-text-edit"
    };
});

Newsletter.directive("imageAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-edit"
    };
});

Newsletter.directive("textAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "text-edit"
    };
});

