var attendApp = angular.module('AttendApp', []);
attendApp.controller('AttendCtlr', function($scope, $http, $location){

	$scope.attendance = [];

	$scope.baseUrl = $location.absUrl();
	$scope.getAttendance = function(){
		$http.get($scope.baseUrl+'/getAttendance?sem='+$scope.sem+'&month='+$scope.month).then(function(response){
			$scope.attendance = response.data
		});
	};
});