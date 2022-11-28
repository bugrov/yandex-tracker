<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/_count
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/count-issues
 *
 * @method IssueGetCountRequest filter(array $filter) Параметры фильтрации задач
 * @method IssueGetCountRequest query(string $filter) Фильтр на языке запросов Яндекс.Трекера
 */
class IssueGetCountRequest extends IssueRequest
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
        'filter',
        'query',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/_count';
    }
}