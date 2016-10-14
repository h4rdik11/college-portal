var student = angular.module('StudentApp',[]);
student.controller('StudentCtlr', function($scope, $location, $http){
	
	$scope.baseUrl = $location.absUrl();
	
	$scope.formSubmit = function(){
		alert($scope.baseUrl+'/addStudent');
		$http.post($scope.baseUrl+'/addStudent', {
			"roll"			: $scope.roll,
			"student_id"	: $scope.sid,
			"name" 			: $scope.name,
			"course" 		: $scope.course,
			"semester"		: $scope.sem,
			"password"		: $scope.password
		}).then(function(response){
			alert(response.data)
		});
	};

	$scope.students = [];

	$scope.display = function(){
		$http.get($scope.baseUrl+'/getStudent').then(function(response){
			$scope.students = response.data
		});
	};
});