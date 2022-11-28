<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issueId/worklog/$worklogId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-worklog
 */
class WorklogDeleteRequest extends WorklogRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId, string $worklogId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/worklog/'.$worklogId;
    }
}