<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Component;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/components
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-components
 */
class ComponentGetAllRequest extends ComponentRequest
{
    const ACTION = 'components';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}