var announceApp = angular.module('AnnounceApp', []);
announceApp.controller('AnnounceCtlr', function($scope, $http, $location){

	$scope.baseUrl = $location.absUrl();
	$scope.courses = [];
	$scope.announcements = [];
	$http.get($scope.baseUrl+'/announcement_upload').then(function(response){
		$scope.announcements = response.data
	});

	$http.get($scope.baseUrl+'/getCourses').then(function(response){
		$scope.courses = response.data
	});

	$scope.readMsg = function(sub, msg){
		alert('Subject : '+sub+'\n'+'Message : '+msg);
	};

});