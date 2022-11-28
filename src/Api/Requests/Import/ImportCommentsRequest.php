<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Import;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/comments/_import
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/import/import-comments
 *
 * @method ImportCommentsRequest text(string $comment) Текст комментария, не более 512000 символов. Обязательное
 * @method ImportCommentsRequest createdAt(string $date) Дата и время создания комментария в формате YYYY-MM-DDThh:mm:ss.sss±hhmm. Обязательное
 * @method ImportCommentsRequest createdBy(string|int $user) Логин или идентификатор автора комментария. Обязательное
 * @method ImportCommentsRequest updatedAt(string $date) Дата и время последнего изменения комментария в формате YYYY-MM-DDThh:mm:ss.sss±hhmm
 * @method ImportCommentsRequest updatedBy(string|int $user) Логин или идентификатор пользователя, который редактировал комментарий последним
 */
class ImportCommentsRequest extends ImportRequest
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
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'text',
        'createdAt',
        'createdBy',
        'updatedAt',
        'updatedBy',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/comments/_import';
    }
}