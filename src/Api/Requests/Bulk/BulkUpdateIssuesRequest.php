<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Bulk;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/bulkchange/_update
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/bulkchange/bulk-update-issues
 *
 * @method BulkUpdateIssuesRequest notify(bool $notify) Признак уведомления пользователей об изменении задачи
 *
 * @method BulkUpdateIssuesRequest issues(array|string $issuesList) Идентификаторы задач, которые необходимо отредактировать. Обязательное
 * @method BulkUpdateIssuesRequest values(array|string $valuesList) Параметры задач, которые будут изменены. Обязательное
 */
class BulkUpdateIssuesRequest extends BulkRequest
{
    const ACTION = 'bulkchange/_update';
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
        'notify',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'issues',
        'values',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}