var assignmentApp = angular.module('AssignmentApp', []);
assignmentApp.controller('AssignmentCtlr',  function($scope, $http, $location){
	
	/* Teacher's Section */
		$scope.assignments = [];
		$scope.baseUrl = $location.absUrl();
		$http.get($scope.baseUrl+'/teacher_upload').then(function(response){
			$scope.assignments = response.data
		});

		$scope.courses = [];
		$http.get($scope.baseUrl+'/getCourses').then(function(response){
			$scope.courses = response.data
		});

		$scope.subjects = [];
		$http.get($scope.baseUrl+'/getSubjects').then(function(response){
			$scope.subjects = response.data
		});

		$scope.ids = [];
		$http.get($scope.baseUrl+'/getAid').then(function(response){
			$scope.ids = response.data
		});

		$scope.s_assigns = [];
		$scope.getAssign = function(){
			$http.post($scope.baseUrl+'/getAssigns', {
				'id'	: $scope.a_id
			}).then(function(response){
				$scope.s_assigns = response.data
			});
		};
	/* End of Teacher's Section */


	/* Student's Section */
		$scope.available = [];
		$http.get($scope.baseUrl+'/availableAssigns').then(function(response){
			$scope.available = response.data 
		});

		$scope.submitedAssigns = [];
		$http.get($scope.baseUrl+'/getSubmittedAssigns').then(function(response){
			$scope.submitAssigns = response.data
		});
	/* End of Student's Section */
});