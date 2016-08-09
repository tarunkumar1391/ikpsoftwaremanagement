/**
 * Created by Haus-IT on 7/6/2016.
 */
var app = angular.module('myApp',['ui.bootstrap','ngAnimate']);
app.controller('pubController',function ($scope,$http) {

    $http.get('../server/fetch.php').then(function (response) {
        $scope.entries = response.data.records;
        console.log($scope.entries);
    })
});
app.controller('pubmodController',function ($scope,$http,$uibModal, $log) {
    $http.get('../server/fetch.php').then(function (response) {

        $scope.entries = response.data.records;

        $scope.animationsEnabled = true;
        $scope.open = function(size){

            $scope.items = this.entry;
            console.log($scope.items);


            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'pubmodmodal.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function () {
                        return $scope.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        $scope.toggleAnimation = function () {
            $scope.animationsEnabled = !$scope.animationsEnabled;
        };

    });
});
app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

    $scope.items = items;


    $scope.ok = function () {
        $uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});