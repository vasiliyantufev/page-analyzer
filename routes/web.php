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

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return view('app');
});

$router->post('/domains', function() {
    $domains = DB::table('domains')->get();

    $timestamps = Carbon::now();
    DB::table('domains')->insert(['name' => 'vasy', 'created_at' => $timestamps, 'updated_at' => $timestamps]);

    dd($domains);
//    return 'hi';
});

$router->get('/key', function() {
    return str_random(32);
});
