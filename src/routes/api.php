<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\Auth\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\Auth\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\Auth\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\Auth\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\Auth\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\Auth\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->group(['prefix' => 'places'], function (Router $api) {
        $api->get('/', 'App\\Api\\V1\\Controllers\\PlaceController@index');
        $api->get('/{id}', 'App\\Api\\V1\\Controllers\\PlaceController@get');
        $api->get('/nearby', 'App\\Api\\V1\\Controllers\\PlaceController@nearBy');
    });

    $api->group(['prefix' => 'skills'], function (Router $api) {
        $api->get('/', 'App\\Api\\V1\\Controllers\\SkillController@index');
        $api->get('/find/{value}', 'App\\Api\\V1\\Controllers\\SkillController@find');
    });
});
