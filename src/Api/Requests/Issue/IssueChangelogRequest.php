<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/changelog
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-changelog
 *
 * @method IssueChangelogRequest id(string $changeId) Идентификатор изменения, за которым следуют запрашиваемые изменения
 * @method IssueChangelogRequest perPage(int $count) Количество изменений на странице
 * @method IssueChangelogRequest field(string $changeParamId) Идентификатор параметра изменений
 * @method IssueChangelogRequest type(string $key) Ключ типа изменения
 */
class IssueChangelogRequest extends IssueRequest
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
        'id',
        'perPage',
        'field',
        'type',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/changelog';
    }
}