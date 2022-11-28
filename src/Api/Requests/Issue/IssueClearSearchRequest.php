<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/system/search/scroll/_clear
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/search-release
 */
class IssueClearSearchRequest extends IssueRequest
{
    const ACTION = 'system/search/scroll/_clear';
    const METHOD = Client::METHOD_POST;

    /**
     * @var array|string[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    public function __construct(?array $tokens)
    {
        $this->data['bodyParams'] = $tokens;
        $this->url = self::ACTION;
    }
}