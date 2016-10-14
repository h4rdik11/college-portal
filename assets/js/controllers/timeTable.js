var ttApp = angular.module('TTApp', []);
ttApp.controller('TTCtlr', function($scope, $http, $location){

	$scope.baseUrl = $location.absUrl();

	$scope.courses = [];
	$http.get($scope.baseUrl+'/getCourses').then(function(response){
		$scope.courses = response.data
	});

	$scope.teachers = [];
	$http.get($scope.baseUrl+'/getTeacher').then(function(response){
		$scope.teachers = response.data
	});

});