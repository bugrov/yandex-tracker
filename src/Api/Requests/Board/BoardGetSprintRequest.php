<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/sprints/$sprintId
 *
 * @see https://cloud.yandex.ru/docs/tracker/get-sprint
 */
class BoardGetSprintRequest extends BoardRequest
{
    const ACTION = 'sprints';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $sprintId)
    {
        $this->url = self::ACTION.'/'.$sprintId;
    }
}