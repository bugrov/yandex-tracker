<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Comment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/comments
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-comments
 */
class CommentGetRequest extends CommentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/comments';
    }
}