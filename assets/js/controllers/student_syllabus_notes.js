var studentSyllabusApp = angular.module('StudentSyllabusNotes', []);
studentSyllabusApp.controller('StudentSyllabusNotesCtlr', function($scope, $http, $location){
	$scope.baseUrl = $location.absUrl();

	$scope.subjects = [];
	$scope.getSubject = function(){
		$http.get($scope.baseUrl+'/getSub?sem='+$scope.sem).then(function(response){
			$scope.subjects = response.data
		});
	};

	$scope.n_subjects = [];
	$scope.getSubjectN = function(){
		$http.get($scope.baseUrl+'/getSub?sem='+$scope.n_sem).then(function(response){
			$scope.n_subjects = response.data
		});
	};

	$scope.syllabus = [];
	$scope.retData = function(){
		$http.get($scope.baseUrl+'/getSyllabus?sem='+$scope.sem+'&subject='+$scope.subject).then(function(response){
			$scope.syllabus = response.data
		});
	};

	$scope.notes = [];
	$scope.retNotes = function(){
		$http.get($scope.baseUrl+'/getNotes?sem='+$scope.n_sem+'&subject='+$scope.n_subject).then(function(response){
			$scope.notes = response.data
		});
	};

});