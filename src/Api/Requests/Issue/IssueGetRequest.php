<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-issue
 *
 * @method IssueGetRequest expand(string $field) Дополнительные поля, которые будут включены в ответ
 */
class IssueGetRequest extends IssueRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

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
        'expand',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId;
    }
}