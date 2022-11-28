<?php

namespace BugrovWeb\YandexTracker\Api\Requests\User;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/users/$uid
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-user
 */
class UserGetRequest extends UserRequest
{
    const ACTION = 'users';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $uid)
    {
        $this->url = self::ACTION.'/'.$uid;
    }
}