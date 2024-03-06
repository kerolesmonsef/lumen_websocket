<?php

namespace App\Providers;

use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\AuthenticateDashboard;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\DashboardApiController;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\SendMessage;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\ShowDashboard;
use BeyondCode\LaravelWebSockets\Statistics\Http\Controllers\WebSocketStatisticsEntriesController;
use Illuminate\Support\ServiceProvider;
use BeyondCode\LaravelWebSockets\Statistics\Http\Middleware\Authorize as AuthorizeStatistics;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Middleware\Authorize as AuthorizeDashboard;

class WebSocketsServiceProvider extends \BeyondCode\LaravelWebSockets\WebSocketsServiceProvider
{
    protected function registerRoutes()
    {
        app('router')->group([
            'prefix' => config('websockets.path'),
            'middleware' => AuthorizeDashboard::class,
        ], function () {
            app('router')->get('/', ShowDashboard::class);
            app('router')->get('/api/{appId}/statistics', [DashboardApiController::class, 'getStatistics', ]);
            app('router')->post('auth', AuthenticateDashboard::class);
            app('router')->post('event', SendMessage::class);

            app('router')->group(['middleware' => AuthorizeStatistics::class], function () {
                app('router')->post('statistics', [WebSocketStatisticsEntriesController::class, 'store', ]);
            });
        });

        return $this;
    }
}
