<?php

namespace BugrovWeb\YandexTracker\Api\Requests\User;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/myself
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-user-info
 */
class UserGetInfoRequest extends UserRequest
{
    const ACTION = 'myself';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}