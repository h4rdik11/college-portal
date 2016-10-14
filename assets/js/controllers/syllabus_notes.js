var syllabusNotes = angular.module('SyllabusNotes', []);
syllabusNotes.controller('SyllabusNotesCtlr', function($scope, $http, $location){

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

	$scope.n_subjects = [];
	$scope.getSubN = function(){
		$http.post($scope.baseUrl+'/getSubs', {
			'course' : $scope.n_course,
			'sem'	 : $scope.n_sem
		}).then(function(response){
			$scope.n_subjects = response.data
		});
	};

	$scope.syllabus = [];
	$scope.displaySyllabus = function(){
		$http.get($scope.baseUrl+'/getSyllabus?course='+$scope.course+'&sem='+$scope.sem+'&subject='+$scope.subject).then(function(response){
			$scope.syllabus = response.data
		});
	};

	$scope.notes = [];
	$scope.displayNotes = function(){
		$http.get($scope.baseUrl+'/getNotes?course='+$scope.n_course+'&sem='+$scope.n_sem+'&subject='+$scope.n_subject).then(function(response){
			$scope.notes = response.data
		});
	};

});