<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Comment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issueId/comments/$commentId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-comment
 */
class CommentDeleteRequest extends CommentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId, $commentId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/comments/'.$commentId;
    }
}