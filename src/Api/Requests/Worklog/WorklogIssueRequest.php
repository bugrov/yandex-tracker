<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/worklog
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/issue-worklog
 */
class WorklogIssueRequest extends WorklogRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/worklog';
    }
}