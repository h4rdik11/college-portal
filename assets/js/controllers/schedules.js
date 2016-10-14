var teacher = angular.module('AssignTeacher', []);
teacher.controller('teacherAssign', ['$scope', '$http', '$location', '$filter' , function($scope, $http, $location,$filter){

		$scope.subjects = [];
		$scope.baseUrl = $location.absUrl();
				
		$scope.subSelect = [];
		$http.get($scope.baseUrl+'/subSelect').then(function(response){
			$scope.subSelect = response.data
		});

		$scope.fillSub = function($name, $id){
			$scope.sub_name = $name;
			$scope.sub_id = $id;	
		};


		$scope.getSubject = function(){
			
			$http.get($scope.baseUrl+'/getSub?sem='+$scope.sem).then(function(response){
				$scope.subjects = response.data
			});
		};

		$scope.addSubject = function(){
			$http.post($scope.baseUrl+'/addSubject', {
				"course" : $scope.new_course,
				"sem" : $scope.new_sem,
				"subject" : $scope.new_subject,
			}).then(function(response){
				$scope.rep = response.data
			});
		};

		$scope.formSubmit = function(){
			$http.post($scope.baseUrl+'/submitAssignment', {
				"course" : $scope.course,
				"sem" : $scope.sem,
				"subject" : $scope.subject,
				"teacher" : $scope.teacher
			}).then(function(response){
				$scope.center2 = response.data;
			});
		};

		$scope.teachers = [];

		$scope.display = function(){
			$http.get($scope.baseUrl+'/getAssign').then(function(response){
				$scope.teachers = response.data
			});
		};


}]);
