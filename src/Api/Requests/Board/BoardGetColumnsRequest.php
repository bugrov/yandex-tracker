<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/boards/$boardId/columns
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-columns
 */
class BoardGetColumnsRequest extends BoardRequest
{
    const ACTION = 'boards';
    const METHOD = Client::METHOD_GET;

    public function __construct(int $boardId)
    {
        $this->url = self::ACTION.'/'.$boardId.'/columns';
    }
}