var coderApp = angular.module('Teacher', []);
coderApp.controller('TeacherController', function($scope, $location, $http){

	$scope.baseUrl = $location.absUrl();
	$scope.formSubmit = function(){
		$http.post($scope.baseUrl+'/addTeacher', {
			"id"		: $scope.id,
			"name" 		: $scope.name,
			"desig" 	: $scope.desig,
			"dept"		: $scope.dept,
			"email"		: $scope.email,
			"password"	: $scope.password
		}).then(function(response){
			alert(response.data);
		});
	};

	$scope.teachers = [];

		$scope.display = function(){
			$http.get($scope.baseUrl+'/getTeacher').then(function(response){
				$scope.teachers = response.data
			});
		};


});