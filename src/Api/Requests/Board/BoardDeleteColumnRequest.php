<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/boards/$boardId/columns/$columnId
 *
 * @see https://cloud.yandex.ru/docs/tracker/delete-column
 */
class BoardDeleteColumnRequest extends BoardRequest
{
    const ACTION = 'boards';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(int $boardId, int $columnId)
    {
        $this->url = self::ACTION.'/'.$boardId.'/columns/'.$columnId;
    }
}