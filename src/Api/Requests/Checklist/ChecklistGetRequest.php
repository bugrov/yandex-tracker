<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Checklist;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/checklistItems
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-checklist
 */
class ChecklistGetRequest extends ChecklistRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/checklistItems';
    }
}