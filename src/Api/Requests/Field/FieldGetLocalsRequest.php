<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId/localFields
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/get-local-fields
 */
class FieldGetLocalsRequest extends FieldRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/localFields';
    }
}