<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/triggers
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/create-trigger
 *
 * @method QueueCreateTriggerRequest name(string $name) Название тригера. Обязательное
 * @method QueueCreateTriggerRequest actions(array $actionsList) Массив с действиями триггера. Обязательное
 * @method QueueCreateTriggerRequest conditions(array $conditionsList) Массив с условиями срабатывания триггера
 * @method QueueCreateTriggerRequest active(bool $isActive) Статус триггера (активный/неактивный)
 */
class QueueCreateTriggerRequest extends QueueRequest
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
        'name',
        'actions',
        'conditions',
        'active',
    ];

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/triggers';
    }
}