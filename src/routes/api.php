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
        
        $api->get('verify', 'App\\Api\\V1\\Controllers\\Auth\\VerifyController@verify');
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

        $api->group(['prefix' => 'places'], function (Router $api) {
            $api->get('/', 'App\\Api\\V1\\Controllers\\PlaceController@index');
            $api->get('/nearby', 'App\\Api\\V1\\Controllers\\PlaceController@nearBy');
            $api->get('/{id}', 'App\\Api\\V1\\Controllers\\PlaceController@get');
        });
    
        $api->group(['prefix' => 'skills'], function (Router $api) {
            $api->get('/', 'App\\Api\\V1\\Controllers\\SkillController@index');
            $api->get('/find/{value}', 'App\\Api\\V1\\Controllers\\SkillController@find');
        });
    
        $api->group(['prefix' => 'users'], function (Router $api) {
            $api->get('/find-by-skill/{id}', 'App\\Api\\V1\\Controllers\\UserController@findBySkill');
            $api->get('/ad-skill/{name}', 'App\\Api\\V1\\Controllers\\UserController@addSkill');
        });

        $api->group(['prefix' => 'me'], function (Router $api) {
            $api->get('/', 'App\\Api\\V1\\Controllers\\UserController@me');
            $api->post('/update', 'App\\Api\\V1\\Controllers\\UserController@update');
            $api->post('/add-skill/{name}', 'App\\Api\\V1\\Controllers\\UserController@addSkill');
            $api->post('/remove-skill/{id}', 'App\\Api\\V1\\Controllers\\UserController@removeSkill');
        });
    });
});
