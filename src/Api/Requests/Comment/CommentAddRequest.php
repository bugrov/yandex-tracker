<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Comment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/comments
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/add-comment
 *
 * @method CommentAddRequest isAddToFollowers(bool $add) Добавить автора комментария в наблюдатели (по умолчанию true)
 *
 * @method CommentAddRequest text(string $comment) Комментарий к задаче. Обязательное
 * @method CommentAddRequest attachmentIds(array|string[] $attachments) Список идентификаторов вложений
 * @method CommentAddRequest summonees(array $summonees) Идентификаторы или логины призванных пользователей
 * @method CommentAddRequest maillistSummonees(array|string[] $mailList) Список рассылок, призванных в комментарии
 */
class CommentAddRequest extends CommentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_POST;

    /**
     * @var array|string[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    /**
     * @var array|string[] get-параметры, доступные для запроса
     */
    protected array $queryParams = [
        'isAddToFollowers',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'text',
        'attachmentIds',
        'summonees',
        'maillistSummonees',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/comments';
    }
}