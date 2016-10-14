var marks = angular.module('MarksApp', []);
marks.controller('MarksCtlr', function($scope, $location, $http){

	$scope.marks = [];
	$scope.baseUrl = $location.absUrl();
	$scope.getDetails = function(){
		$http.get($scope.baseUrl+'/getMarks?sem='+$scope.sem).then(function(response){
			$scope.marks = response.data
		});
	};

});