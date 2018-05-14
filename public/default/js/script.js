angular.module('RoutingApp', ['ngRoute'])
	.config( ['$routeProvider', function($routeProvider) {
		$routeProvider
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.when('/first', {
				templateUrl: 'first.php'
			})
			.when('/second', {
				templateUrl: 'second.php'
			})
			.otherwise({
				redirectTo: '/'
			});
	}]);