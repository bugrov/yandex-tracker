<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/queues/$queueId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/delete-queue
 */
class QueueDeleteRequest extends QueueRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId;
    }
}