<?php

namespace App;

use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\Statistics\Logger\HttpStatisticsLogger;


class MyCustomLogger extends HttpStatisticsLogger
{
    public function save()
    {
        foreach ($this->statistics as $appId => $statistic) {
            if (! $statistic->isEnabled()) {
                continue;
            }

            $postData = array_merge($statistic->toArray(), [
                'secret' => App::findById($appId)->secret,
            ]);



            $webSocketsStatisticsEntryModelClass = config('websockets.statistics.model');

            $statisticModel = $webSocketsStatisticsEntryModelClass::create([
                'app_id' => $postData['app_id'],
                'peak_connection_count' => $postData['peak_connection_count'],
                'websocket_message_count' => $postData['websocket_message_count'],
                'api_message_count' => $postData['api_message_count'],
            ]);
//
//            broadcast(new StatisticsUpdated($statisticModel));
//            $this
//                ->browser
//                ->post(
//                    action([WebSocketStatisticsEntriesController::class, 'store']),
//                    ['Content-Type' => 'application/json'],
//                    Utils::streamFor(json_encode($postData))
//                );

            $currentConnectionCount = $this->channelManager->getConnectionCount($appId);
            $statistic->reset($currentConnectionCount);
        }
    }
}
