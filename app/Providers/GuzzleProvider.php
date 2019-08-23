<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class GuzzleProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $client = new GuzzleHttp\Client();
//        $res = $client->request('GET', 'ya.ru', [
//            'auth' => ['user', 'pass']
//        ]);
//        echo $res->getStatusCode();
//        // "200"
//        echo $res->getHeader('content-type')[0];
//        // 'application/json; charset=utf8'
//        echo $res->getBody();

        $this->app->bind('GuzzleHttp\Client', function(){
            return new Client();
        });
    }
}
