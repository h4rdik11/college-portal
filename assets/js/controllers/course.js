var course = angular.module('CourseApp', []);
course.controller('CourseCtlr', function($scope, $location, $http){

	$scope.baseUrl = $location.absUrl();
	$scope.formSubmit = function(){
		$http.post($scope.baseUrl+'/addCourse', {
			"course_name"   : $scope.name,
			"course_code"   : $scope.code,
			"course_dept" 	: $scope.dept,
			"course_fac"	: $scope.faculty

		}).then(function(response){
			alert(response.data);
		});
	};

	$scope.courses = [];
	$scope.display = function(){
		$http.get($scope.baseUrl+'/getCourse').then(function(response){
			$scope.courses = response.data
		});
	};

});