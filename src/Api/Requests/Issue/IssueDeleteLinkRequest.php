<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issueId/links/$linkId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-link-issue
 */
class IssueDeleteLinkRequest extends IssueRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId, int $linkId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/links/'.$linkId;
    }
}