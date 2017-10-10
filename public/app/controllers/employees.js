app.controller('employeesController', function($scope, $http, API_URL) {
    //retrieve employees listing from API


            function init(){
                $http.get(API_URL + "employees")
                .then(function(response) {
                    $scope.employees = response.data;
                    
                });
                $scope.employee = {};
            }

            init();
    
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;
        $scope.employee = {};

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get(API_URL + 'employees/' + id)
                        .then(function(response) {
                            console.log(response);
                            $scope.employee = response.data;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "employees";
        
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            if(response.data.success){               
                $('#myModal').modal('hide');
                init();
            }
            else{
                $scope.errors = [];
                for(var i in response.data.errors){
                   
                    $scope.errors = $scope.errors.concat(response.data.errors[i]);
                    console.log( $scope.errors)
                }

                

            }
            
        }, function(error){
            console.log(error);
        })
    }

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'employees/' + id
            }).then(function(data) {
                        if(data.success){
                            init();
                        }
                        else{
                            $scope.errors = data.errors
                        }
                        
                    }, function(error){
                        console.log(error);
                    })                    
        } else {
            return false;
        }
    }
});