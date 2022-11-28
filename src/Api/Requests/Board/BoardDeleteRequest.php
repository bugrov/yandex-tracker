<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/boards/$boardId
 *
 * @see https://cloud.yandex.ru/docs/tracker/delete-board
 */
class BoardDeleteRequest extends BoardRequest
{
    const ACTION = 'boards';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(int $boardId)
    {
        $this->url = self::ACTION.'/'.$boardId;
    }
}