var noticeBoard = angular.module('NoticeBoard', []);
noticeBoard.controller('NoticeBoardCtlr', function($scope, $http, $location){
	
	$scope.baseUrl = $location.absUrl();
		
	$scope.notices = [];
	$http.get($scope.baseUrl+'/getNotices').then(function(response){
		$scope.notices = response.data
	});

	$scope.announcements = [];
	$http.get($scope.baseUrl+'/getAnnouncements').then(function(response){
		$scope.announcements = response.data
	});

	$scope.readMsg = function(sub, msg){
		alert('Subject : '+sub+'\n'+'Message : '+msg);
	};
});