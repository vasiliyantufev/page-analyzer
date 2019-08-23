<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    //return $router->app->version();
    return view('home');
});

$router->post('domains', 'DomainsController@create');
$router->get('domains/{id}', 'DomainsController@show');
$router->get('domains', 'DomainsController@all');

//$router->get('/genKey', function() {
//    return str_random(32);
//});

$router->get('/test', function() {
    $client = new GuzzleHttp\Client();

    $res = $client->request('GET', 'ya.ru', [
        'auth' => ['user', 'pass']
    ]);
    //echo $res->getStatusCode();
    // "200"
    //echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    echo $res->getBody();
    //return str_random(32);
});
