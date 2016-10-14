var noticeApp = angular.module('NoticeApp', []);
noticeApp.controller('NoticeCtlr', function($scope, $http, $location){

	$scope.baseUrl = $location.absUrl();
	$scope.notices = []
	$http.get($scope.baseUrl+'/get_notice').then(function(response){
		$scope.notices = response.data
	});

	$scope.readMsg = function(sub, msg){
		alert('Subject : '+sub+'\n'+'Message : '+msg);
	};

});