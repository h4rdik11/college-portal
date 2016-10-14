var adminNotice = angular.module('AdminNoticeApp', []);
adminNotice.controller('AdminNoticeCtlr', function($scope, $http, $location){
	
	$scope.baseUrl = $location.absUrl();
	
	$scope.notices = [];
	$http.get($scope.baseUrl+'/getNotice').then(function(response){
		$scope.notices = response.data
	});

	$scope.readMsg = function(sub, msg){
		alert('Subject : '+sub+'\n'+'Message : '+msg);
	};

});