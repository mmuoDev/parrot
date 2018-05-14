'use strict';

// Declare app level module which depends on views, and components
angular.module('App', [
  'ngRoute',
  'auth',
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.otherwise({redirectTo: '/view1'});
}]);