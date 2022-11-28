<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/tags/_remove
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/delete-tag
 *
 * @method QueueDeleteTagRequest tag(string $tagName) Имя тега. Обязательное
 */
class QueueDeleteTagRequest extends QueueRequest
{
    const ACTION = 'queues';
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
        'tag',
    ];

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/tags/_remove';
    }
}