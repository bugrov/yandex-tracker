<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Macros;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/queues/$queueId/macros/$macrosId
 *
 * @see https://cloud.yandex.ru/docs/tracker/delete-macros
 */
class MacrosDeleteRequest extends MacrosRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $queueId, string $macrosId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/macros/'.$macrosId;
    }
}