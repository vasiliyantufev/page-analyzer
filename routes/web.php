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

use Illuminate\Support\Facades\App;

$router->get('/', ['as' => 'index', function () {

    //echo trans('messages.welcome');
    return view('home');
}]);

$router->get('domains', [
    'as' => 'domains.index', 'uses' => 'DomainsController@index'
]);

$router->get('domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainsController@show'
]);

$router->post('domains', [
    'as' => 'domains.store', 'uses' => 'DomainsController@store'
]);

//$router->get('/genKey', function() {
//    return str_random(32);
//});
