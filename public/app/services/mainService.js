(function (app) {
	var MainService = ['$http','API_URL',function ($http,API_URL) {
		var service = {};

		service.init = function(){
			return $http.get(API_URL+'init',{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		}

        service.getTags = function(){
            return $http.get(API_URL+'get-tags',{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		}
		
		service.saveTag = function(tag){
			return $http.post(API_URL+'save-tag',{title: tag})
		}

		service.deleteTag = function(id){
			return $http.post(API_URL+'delete-tag',{id: id})
		}

		service.saveFilm = function(data){
			if(data.id){
				return $http.post(API_URL+'film/'+data.id,data)
			}
			return $http.post(API_URL+'film',data)
		}

		service.getFilm = function(id){
			return $http.get(API_URL+'film/'+id)
		}

		service.deleteFilm = function(id){
			return $http.post(API_URL+'film/delete',{id:id})
		}

		

		return service;
	}];
	app.factory('MainService', MainService);
})(app);

