<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

use App\Events\SendMessageEvent;
use App\Http\Controllers\TestController;

$router->get('/', function () use ($router) {
    event(new SendMessageEvent("this is test message"));
    return $router->app->version();
});


$router->get("/test",function (){
    action([])->action();
});
