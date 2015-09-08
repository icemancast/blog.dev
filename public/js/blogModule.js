(function() {
    "use strict";

    var app = angular.module("blogModule", []);

    const TOKEN = $("meta[name=csrf-token]").attr("content");

    app.constant("CSRF_TOKEN", TOKEN);

    app.config(["$httpProvider", "CSRF_TOKEN", function($httpProvider, CSRF_TOKEN) {
        $httpProvider.defaults.headers.common["X-Csrf-Token"] = CSRF_TOKEN;
        $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    }]);

    app.controller("ManageController", ["$http", "$log", "$scope", function($http, $log, $scope) {
        $scope.posts = [];

        $http.get('/posts/list').then(function(response) {
            $log.info("Post list success response");

            $scope.posts = response.data;
        }, function(response) {
            $log.error("Post list error response!");

            $log.debug(response);
        });

        $scope.deletePost = function(index) {
            var post = $scope.posts[index];

            $http.delete('/posts/' + post.id).then(function(response) {
                $log.info("Post deleted!");

                $scope.posts.splice(index, 1);
            }, function(response) {
                $log.error("Failed to delete post!");

                $log.debug(response);
            });
        }
    }]);
})();
