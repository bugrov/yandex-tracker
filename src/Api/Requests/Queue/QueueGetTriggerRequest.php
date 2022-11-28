<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId/triggers/$triggerId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/get-trigger
 */
class QueueGetTriggerRequest extends QueueRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $queueId, int $triggerId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/triggers/'.$triggerId;
    }
}