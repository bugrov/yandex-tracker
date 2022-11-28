<?php

namespace BugrovWeb\YandexTracker\Api\Requests\External;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/remotelinks
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-external-links
 */
class ExternalGetLinksRequest extends ExternalRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/remotelinks';
    }
}