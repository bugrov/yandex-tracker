<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Comment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/issues/$issueId/comments/$commentId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/edit-comment
 *
 * @method CommentEditRequest text(string $comment) Скорректированный комментарий к задаче. Обязательное
 * @method CommentEditRequest attachmentIds(array|string[] $attachments) Список идентификаторов вложений
 */
class CommentEditRequest extends CommentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_PATCH;

    /**
     * @var array|string[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'text',
        'attachmentIds',
    ];

    public function __construct(string $issueId, $commentId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/comments/'.$commentId;
    }
}