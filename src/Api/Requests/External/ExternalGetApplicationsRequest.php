<?php

namespace BugrovWeb\YandexTracker\Api\Requests\External;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/applications
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-applications
 */
class ExternalGetApplicationsRequest extends ExternalRequest
{
    const ACTION = 'applications';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}