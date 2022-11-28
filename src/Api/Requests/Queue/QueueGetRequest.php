<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/$queueId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/get-queue
 *
 * @method QueueGetRequest expand(string $field) Дополнительные поля, которые будут включены в ответ
 */
class QueueGetRequest extends QueueRequest
{
    const ACTION = 'queues';
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

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId;
    }
}