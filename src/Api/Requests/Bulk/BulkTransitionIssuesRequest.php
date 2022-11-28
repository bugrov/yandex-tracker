<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Bulk;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/bulkchange/_transition
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/bulkchange/bulk-transition
 *
 * @method BulkTransitionIssuesRequest notify(bool $notify) Признак уведомления пользователей об изменении задачи
 *
 * @method BulkTransitionIssuesRequest transition(string $transitionId) Идентификатор перехода. Обязательное
 * @method BulkTransitionIssuesRequest issues(array|string $issuesList) Идентификаторы задач, статус которых необходимо изменить. Обязательное
 * @method BulkTransitionIssuesRequest values(array|string $valuesList) Параметры задач, которые будут изменены при смене статуса
 */
class BulkTransitionIssuesRequest extends BulkRequest
{
    const ACTION = 'bulkchange/_transition';
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
        'transition',
        'issues',
        'values',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}