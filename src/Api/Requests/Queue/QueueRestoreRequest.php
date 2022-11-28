<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/_restore
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/restore-queue
 */
class QueueRestoreRequest extends QueueRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_POST;

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/_restore';
    }
}