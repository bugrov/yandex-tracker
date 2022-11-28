<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Checklist;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issueId/checklistItems
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-checklist
 */
class ChecklistDeleteRequest extends ChecklistRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/checklistItems';
    }
}