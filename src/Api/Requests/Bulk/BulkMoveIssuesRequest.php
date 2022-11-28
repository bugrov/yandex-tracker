<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Bulk;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/bulkchange/_move
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/bulkchange/bulk-move-issues
 *
 * @method BulkMoveIssuesRequest notify(bool $notify) Признак уведомления пользователей об изменении задачи
 *
 * @method BulkMoveIssuesRequest queue(string $key) Ключ очереди, в которую планируется перенести задачи. Обязательное
 * @method BulkMoveIssuesRequest issues(array|string $issuesList) Идентификаторы задач, которые необходимо перенести. Обязательное
 * @method BulkMoveIssuesRequest values(array|string $valuesList) Параметры задач, которые будут изменены при переносе
 * @method BulkMoveIssuesRequest moveAllFields(bool $move) Перенос версий, компонентов и проектов задачи в новую очередь (перенести/нет)
 * @method BulkMoveIssuesRequest initialStatus(bool $clear) Сброс статуса задачи в начальное значение
 */
class BulkMoveIssuesRequest extends BulkRequest
{
    const ACTION = 'bulkchange/_move';
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
        'queue',
        'issues',
        'values',
        'moveAllFields',
        'initialStatus',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}