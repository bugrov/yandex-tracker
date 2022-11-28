<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/priorities
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-priorities
 *
 * @method IssueGetPrioritiesRequest localized(bool $localized) Признак наличия переводов в ответе
 */
class IssueGetPrioritiesRequest extends IssueRequest
{
    const ACTION = 'priorities';
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
        'localized',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}