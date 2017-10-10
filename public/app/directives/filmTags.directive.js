(function (app) {
    var filmTags = ['$http','$filter','$timeout','MainService',function ($http,$filter,$timeout,MainService) {
      return {
        restrict: 'E',
        replace: false,
        scope: {
          tagList: '=',
          checkedTags: '=',
          callbackFn: '&',
          isSingleFilm: '@'
        },
        templateUrl: 'app/directives/template/filmTags.html',
        link: function ($scope, $element) {
            $scope.checkedTags = $scope.checkedTags || [];
            $scope.checkedArr = [];

            $scope.isChecked = function(tag){
                return $scope.checkedTags.indexOf(tag.id) != -1; 
                /*
                for(var i=0; i<$scope.checkedTags.length; i++){
                    if($scope.checkedTags[i].id ==tag.id) {
                        if($scope.checkedArr.indexOf(tag.id) == -1){
                            $scope.checkedArr.push(tag.id);
                        }
                        return true;
                    }
                }
                return false;*/
            }
           
            $scope.addTag = function(){
                if(!$scope.newTag) return;
                for(var i = 0;i<$scope.tagList.length;i++ ){
                    if($scope.tagList[i].title == $scope.newTag ){
                        $scope.error = 'Tag already exists';
                        $timeout(function(){
                            $scope.error = '';
                        },2000);
                        return;
                    }
                }
                
                MainService.saveTag($scope.newTag).then(function(response){
                    if(response.data.success){
                        $scope.tagList.push({id: response.data.id,title:$scope.newTag });
                        $scope.newTag = '';
                        $scope.error = '';
                    }else{
                        $scope.error = 'Error to saving data'; //response.data.errors
                    };
                }, function(error){

                });
            }

            $scope.deleteTag = function(id){              
                if(! confirm("Delete ?")) return;
                MainService.deleteTag(id).then(function(response){
                    if(response.data.success){
                        //Initialize the app
                        $scope.callbackFn();
                    }
                }, function(error){

                });

            }

           /* $scope.toggleSelected = function(){
                
                $scope.checkedTags = $filter('filter')($scope.tagList, {checked: true});
                console.log($scope.checkedTags);                
            }*/

            $scope.toggle = function(id){
                /*
                var index = $scope.checkedTags.indexOf(id);
                if(index == -1){
                    $scope.checkedTags.push(id);
                }else{
                    $scope.checkedTags.splice(index,1)
                }*/
                //TODO
            var selected = [];
            $('input:checked').each(function() {
                selected.push(parseInt($(this).attr('data-id')));
            });
            $scope.checkedTags = selected;
            }
 
            

  
        }
      };
    }];
    app.directive('filmTags', filmTags);
  })(app);