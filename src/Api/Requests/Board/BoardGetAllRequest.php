<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/boards
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-boards
 */
class BoardGetAllRequest extends BoardRequest
{
    const ACTION = 'boards';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}