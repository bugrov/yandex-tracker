<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/fields
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-global-fields
 */
class FieldGetGlobalsRequest extends FieldRequest
{
    const ACTION = 'fields';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}