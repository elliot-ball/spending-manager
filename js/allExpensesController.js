// module
var allExpensesPageController = angular.module('allExpensesPageController',[]);

// links controller to namespace
allExpensesPageController.controller('ExpensesTableController', ['$scope', '$http', function ($scope,$http) {
  $http.get("http://localhost:8080/Spending%20Manager/2.1/server/getAllExpenses.php")
  .success(function(response) {
    $scope.names = response;
  });
}]);
