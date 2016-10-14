var marksUpload = angular.module('MarksUpload', []);
marksUpload.controller('MarksUploadCtlr', function($scope, $http, $location){

	$scope.baseUrl = $location.absUrl();

	$scope.courses = [];
	$http.get($scope.baseUrl+'/getCourses').then(function(response){
		$scope.courses = response.data
	});

	$scope.subjects = [];
	$scope.getSub = function(){
		$http.post($scope.baseUrl+'/getSubs', {
			'course' : $scope.course,
			'sem'	 : $scope.sem
		}).then(function(response){
			$scope.subjects = response.data
		});
	};

	$scope.marks = [];
	$scope.display = function(){
		$http.post($scope.baseUrl+'/getMarks?course='+$scope.course+'&sem='+$scope.sem+'&subject='+$scope.subject).then(function(response){
			$scope.marks = response.data
		});
	};
});