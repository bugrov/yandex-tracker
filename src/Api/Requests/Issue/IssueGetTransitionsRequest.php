<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/transitions
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-transitions
 */
class IssueGetTransitionsRequest extends IssueRequest
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

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/transitions';
    }
}