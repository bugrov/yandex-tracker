<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId/autoactions/$autoActionId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/get-autoaction
 */
class QueueGetAutoActionRequest extends QueueRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $queueId, int $autoActionId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/autoactions/'.$autoActionId;
    }
}