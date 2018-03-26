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
            $api->get('/{id}', 'App\\Api\\V1\\Controllers\\PlaceController@get');
            $api->get('/find/nearby', 'App\\Api\\V1\\Controllers\\PlaceController@findNearBy');
        });
    
        $api->group(['prefix' => 'skills'], function (Router $api) {
            $api->get('/', 'App\\Api\\V1\\Controllers\\SkillController@index');
            $api->get('/find/{value}', 'App\\Api\\V1\\Controllers\\SkillController@find');
        });

        $api->group(['prefix' => 'sessions'], function (Router $api) {
            $api->get('/find/place/{id}', 'App\\Api\\V1\\Controllers\\SessionController@findByPlace');
            $api->get('/find/user', 'App\\Api\\V1\\Controllers\\SessionController@findByUser');
        });
    
        $api->group(['prefix' => 'users'], function (Router $api) {
            $api->get('/find/skill/{id}', 'App\\Api\\V1\\Controllers\\UserController@findBySkill');
        });

        $api->group(['prefix' => 'me'], function (Router $api) {
            $api->get('/', 'App\\Api\\V1\\Controllers\\MeController@index');
            $api->post('/update', 'App\\Api\\V1\\Controllers\\MeController@update');
            $api->get('/sessions', 'App\\Api\\V1\\Controllers\\MeController@getSessions');
            $api->post('/sessions', 'App\\Api\\V1\\Controllers\\MeController@createSession');
            $api->post('/skills/{name}', 'App\\Api\\V1\\Controllers\\MeController@addSkill');
            $api->delete('/skills/{id}', 'App\\Api\\V1\\Controllers\\MeController@removeSkill');
        });
    });
});
