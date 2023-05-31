<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/worklog
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/issue-worklog
 *
 * @method WorklogIssueRequest perPage(int $count) Количество задач на странице ответа
 * @method WorklogIssueRequest page(int $pageNumber) Номер страницы ответа
 */
class WorklogIssueRequest extends WorklogRequest
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
        'perPage',
        'page',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/worklog';
    }
}