<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/links
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-links
 */
class IssueGetLinksRequest extends IssueRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/links';
    }
}