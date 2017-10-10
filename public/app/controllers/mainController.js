app.controller('MainController', function($scope, $http,  MainService) {

        $scope.init = function(){
            MainService.init()
                .then(function(response) {
                    $scope.films = response.data.films;
                    $scope.tagList = response.data.tags;
                    
                });
           
        }

        $scope.init();

        $scope.showTags = function(tags){
            var arr = tags.reduce(function(acc, item){
                acc.push(item.title);
                return acc;
            },[]);
            return arr.join(',');
        }
        

        $scope.addNewFilmModal = function(){
            $('#filmsModal').modal('show');            
            $scope.film = {checkedList:[]};
            $scope.errorFilm = [];
            $scope.loading = true;
            MainService.getTags()
                        .then(function(response){
                            console.log(response.data);    
                            $scope.loading = false;
                            $scope.tagList = response.data.tags;
                        },
                        function(error){
                            
                        })
        }

        $scope.saveFilm = function(){
            $scope.errorFilm = [];
            //@TODO
            if(!$scope.film.title){
                $scope.errorFilm.push('Title is required');
            }
            if(!$scope.film.year){
                $scope.errorFilm.push('Year is required');
            }
            if(!$scope.film.checkedTags || $scope.film.checkedTags.length == 0){
                $scope.errorFilm.push('Tag is required');
            }
            if($scope.errorFilm.length > 0) return;

            
            var formData = {
                title: $scope.film.title,
                year: $scope.film.year,
                tags: $scope.film.checkedTags,
                id:$scope.film.id
            };
           $scope.loading = true;
            MainService.saveFilm(formData)
                        .then(function(response){
                            $scope.loading = false;
                            if(response.data.success){
                                $scope.init();
                                $('#filmsModal').modal('hide');
                            }else{
                                $scope.errorFilm = [];
                                for(var i in response.data.errors){                                    
                                     $scope.errorFilm = $scope.errorFilm.concat(response.data.errors[i]);
                                     
                                 }
                            }                            
                        }, function(error){
                            $scope.loading = false;
                        })

        }

        $scope.editFilm = function(id){
            $scope.loading = true;           
            $scope.film = {checkedTags:[]}; 
            $('#filmsModal').modal('show');
                MainService.getFilm(id)
                .then(function(response){                                   

                    $scope.loading = false;
                    

                    response.data.tags.map(function(item){
                        $scope.film.checkedTags.push(item.id);
                    });
                    $scope.film = {
                        id: response.data.id,
                        title: response.data.title,
                        year: parseInt(response.data.year),
                        checkedTags:$scope.film.checkedTags
                    };
                },
                function(error){
                    console.log(error)
                })
        }

        $scope.deleteFilm = function(id){
            if(!confirm('Delete ?')) return;
            MainService.deleteFilm(id).then(function(response){
                if(response.data.success){
                    $scope.init();
                }else{
                    alert('Error');
                }
            },function(error){

            })
        }

    
});