var welcomeApp = angular.module('WelcomeApp', []);
welcomeApp.controller('WelcomeCtlr', function($scope, $http, $location){

	$scope.baseUrl = $location.absUrl();

	$scope.mcaTT = [];
	$http.get($scope.baseUrl+'/Welcome/getMCA').then(function(response){
		$scope.mcaTT = response.data
	});

	$scope.teacherTT = [];
	$http.get($scope.baseUrl+'/welcome/getTeacherTT').then(function(response){
		$scope.teacherTT = response.data
	});

	$scope.notices = [];
	$http.get($scope.baseUrl+'/welcome/getAdminNotice').then(function(response){
		$scope.notices = response.data
	});

	$scope.readMsg = function(sub, msg){
		alert('Subject : '+sub+'\n'+'Message : '+msg);
	};

});