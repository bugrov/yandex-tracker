<?php

namespace BugrovWeb\YandexTracker\Api\Requests\External;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issueId/remotelinks/$externalLinkId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-external-link
 */
class ExternalDeleteLinkRequest extends ExternalRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId, string $externalLinkId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/remotelinks/'.$externalLinkId;
    }
}