var myApp = angular.module('myApp', []);

myApp.controller('AllExpensesCTRL', ['$scope','$http','$filter', function ($scope, $http, $filter){
  $scope.names = "";
  // Retrives all expenses
	$http.get("server/getAllExpenses.php")
  .success(function(response) {
    $scope.names = response;
  });

  // Retrieves all categories to populate drop down
  $http.get("server/getAllCategories.php")
  .success(function(response) {
    $scope.categories = response;
  });

  // Pass in category id
  // Returns category name
  function getCategoryName(id){
    for (var i = 0, len = $scope.categories.length; i < len; i++) {
      if ($scope.categories[i].id == id) {
         return $scope.categories[i].name;
      }
    }
  }

  // Handles adding of new expenses
  $scope.newExpense = function() {
    // $scope.names = { name: $scope.categoryId, amount: $scope.amount, date: $scope.date, description: $scope.description }; 
    
    // Add the new expense to the table
    $scope.names.push({ 
      name: getCategoryName($scope.categoryId), // Get the category name by using the Id
      amount: $scope.amount,
      date: $filter('date')($scope.date,"dd/MM/yyyy"), // Convert to uk date format
      description: $scope.description
    }); 

    // Add the new expense to the database
    var request = $http({
      method: "post",
      url: window.location.href + "server/newExpense.php",
      data: {
          categoryId: $scope.categoryId,
          amount: $scope.amount,
          date: $scope.date,
          description: $scope.description
      },
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });
  }

  // Pass id of expense to delete
  // Use id to locate expense in array
  // Remove expense from array
  // Remove expense from database
  $scope.deleteExpense = function(id) {
    var index = -1;   
    var comArr = $scope.names;
    // var comArr = eval( $scope.names ); // What is the benfit of eval() ?
    for (var i = 0, len = comArr.length; i < len; i++) {
      if (comArr[i].id === id) {
        index = i;
        break;
      }
    }
    if( index === -1 ) {
      alert( "Error: Couldn't delete expense" );
    }
    else {
      $scope.names.splice( index, 1 ); // Remove item from array

      // Remove item from database
      var request = $http({
        method: "post",
        url: window.location.href + "server/deleteExpense.php",
        data: {
            id: id
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }); 
    }
  }   
}]);






// var myApp = angular.module('myApp', [
// 	'ngRoute',
// 	'allExpensesPageController'
// ]);

// // routeProvider service
// // dictates what partial to load when the url is in a state
// myApp.config(['$routeProvider', function($routeProvider) {
// 	$routeProvider.
// 	when('/allExpenses', {
// 		templateUrl: 'partials/allExpenses.html',
// 		controller: 'allExpensesPageController'
// 	}).
// 	otherwise({
// 		redirectTo: '/allExpenses'
// 	});
// }]);