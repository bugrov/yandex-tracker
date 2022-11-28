<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Macros;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId/macros
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-macroses
 */
class MacrosGetAllRequest extends MacrosRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/macros';
    }
}