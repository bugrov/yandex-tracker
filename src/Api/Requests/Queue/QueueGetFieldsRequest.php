<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId/fields
 */
class QueueGetFieldsRequest extends QueueRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/fields';
    }
}