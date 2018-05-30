var app = angular.module('app', ['ngRoute']);

app.config(function($routeProvider,$locationProvider) {
    $locationProvider.hashPrefix('');
	$routeProvider

	// route for the home page
	.when('/', {
		templateUrl : 'pages/home.html',
		controller  : 'mainController'
	})

	// route for the about page
	.when('/about', {
		templateUrl : 'pages/about.html',
		controller  : 'aboutController'
	})

	// route for the contact page
	.when('/contact', {
		templateUrl : 'pages/contact.html',
		controller  : 'contactController'
	})

	// route for the customers page
	.when('/customers', {
		templateUrl : 'pages/customers.html',
		controller  : 'customersController'
	})

	.otherwise({redirectTo: '/'});
});

app.controller('mainController', function($log, $scope, appService) {
	$scope.message = 'Everyone come and see how good I look!';
});

app.controller('aboutController', function($log, $scope, appService) {
	$scope.message = 'Look! I am an about page.';
});

app.controller('contactController', function($log, $scope, appService) {
	$scope.message = 'Contact us! JK. This is just a demo.';
});

app.controller('customersController', function($log, $scope, appService) {
	$scope.message = 'Customers';

	function init() {
		getCustomers();
	}
	init();

	function getCustomers() {
		appService.getCustomers()
			.then(function(response){
				if(Array.isArray(response.data))
					$scope.customers = response.data;
				else
					$log.error("Errore nel metodo \"getCustomers\". Messaggio errore: " + response.data);
			},
			function(error){
				$log.error(error);
			});
	}

});

app.service('appService', function($http) {

	this.getCustomers = function () {
    var config = {
        method: "POST",
        data: {
            type: "GetClienti",
            value: "0"
        },
        url: "/sirmeferroviaria/controller/GeneralController.php",
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    }
    return $http(config).then(function successCallback(response) {
        return response;
    }, function errorCallback(response) {
        return response;
    });
	}

});