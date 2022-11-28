<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/links
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/link-issue
 *
 * @method IssueLinkRequest relationship(string $type) Тип связи между задачами. Обязательное
 * @method IssueLinkRequest issue(string $issueId) Идентификатор или ключ связываемой задачи. Обязательное
 */
class IssueLinkRequest extends IssueRequest
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
        'relationship',
        'issue',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/links';
    }
}