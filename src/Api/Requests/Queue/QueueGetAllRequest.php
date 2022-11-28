<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/queues/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/get-queues
 *
 * @method QueueGetAllRequest expand(string $field) Дополнительные поля, которые будут включены в ответ
 * @method QueueGetAllRequest perPage(int $count) Количество очередей на странице ответа
 * @method QueueGetAllRequest page(int $pageNumber) Номер страницы ответа
 */
class QueueGetAllRequest extends QueueRequest
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
        'perPage',
        'page',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/';
    }
}