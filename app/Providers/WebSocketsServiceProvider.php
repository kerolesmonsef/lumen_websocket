<?php

namespace App\Providers;

use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\AuthenticateDashboard;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\DashboardApiController;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\SendMessage;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\ShowDashboard;
use BeyondCode\LaravelWebSockets\Statistics\Http\Controllers\WebSocketStatisticsEntriesController;
use BeyondCode\LaravelWebSockets\Statistics\Http\Middleware\Authorize as AuthorizeStatistics;

class WebSocketsServiceProvider extends \BeyondCode\LaravelWebSockets\WebSocketsServiceProvider
{
    protected function registerRoutes()
    { // here too
//        app('router')->group([
//            'prefix' => config('websockets.path'),
//        ], function () {
//            app('router')->get('/', ShowDashboard::class);
//            app('router')->get('/api/{appId}/statistics', [DashboardApiController::class, 'getStatistics', ]);
//            app('router')->post('auth', AuthenticateDashboard::class);
//            app('router')->post('event', SendMessage::class);
//
//            app('router')->group(['middleware' => AuthorizeStatistics::class], function () {
//                app('router')->post('statistics', [WebSocketStatisticsEntriesController::class, 'store', ]);
//            });
//        });

        return $this;
    }
}
