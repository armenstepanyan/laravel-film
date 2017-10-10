<html lang="en-US" ng-app="angularLaravel">
    <head>
        <title>Laravel 5 AngularJS Films CRUD Example</title>

        <!-- Load Bootstrap CSS -->
        <link href="<?= asset('bootstrap.min.css') ?>" rel="stylesheet">
    </head>
    <body>
        
        <div class="container">
        <h2>The films</h2>
            <div  ng-controller="MainController">

                <!-- Table-to-load-the-data Part -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Tags</th> 
                            <th><button class="btn btn-primary btn-xs" ng-click="addNewFilmModal()">Add New Film</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="film in films">
                            <td>{{  film.id }}</td>
                            <td>{{ film.title }}</td>
                            <td>{{ film.year }}</td>
                            <td>{{ showTags(film.tags) }}</td>                            
                            <td>
                                <button class="btn btn-default btn-xs btn-detail" ng-click="editFilm(film.id)">Edit</button>
                                <button class="btn btn-danger btn-xs btn-delete" ng-click="deleteFilm(film.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              <hr/>
              <film-tags
                ng-if="tagList"
                tag-list="tagList"
                checked-tags="checkedTags"
                callback-fn="init()"
              >
              </film-tags>

              <div>
                    <div ng-include=" 'app/views/modals.html' "></div>
              </div>
              
            </div>
        </div>

        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="<?= asset('js/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/mainController.js') ?>"></script>
        <script src="<?= asset('app/directives/filmTags.directive.js') ?>"></script>
        <script src="<?= asset('app/services/mainService.js') ?>"></script>
    </body>
</html>