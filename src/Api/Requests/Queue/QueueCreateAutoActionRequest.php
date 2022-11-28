<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/autoactions
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/create-autoaction
 *
 * @method QueueCreateAutoActionRequest name(string $name) Название автодействия. Обязательное
 * @method QueueCreateAutoActionRequest filter(array $filter) Массив с условиями фильтрации полей задач, для которых сработает автодействие. Обязательное (если не задано query)
 * @method QueueCreateAutoActionRequest query(string $query) Строка запроса фильтрации задач, для которых сработает автодействие (на языке запросов Яндекс.Трекера). Обязательное (если не задано filter)
 * @method QueueCreateAutoActionRequest actions(array $issueActions) Массив с действиями над задачами. Обязательное
 * @method QueueCreateAutoActionRequest active(bool $isActive) Статус автодействия (активный/неактивный)
 * @method QueueCreateAutoActionRequest enableNotifications(bool $enable) Статус отправки уведомлений (отправлять/не отправлять)
 * @method QueueCreateAutoActionRequest intervalMillis(int $milliseconds) Периодичность запуска автодействия в миллисекундах
 * @method QueueCreateAutoActionRequest calendar(array $period) Период, в который автодействие активно
 */
class QueueCreateAutoActionRequest extends QueueRequest
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
        'filter',
        'query',
        'actions',
        'active',
        'enableNotifications',
        'intervalMillis',
        'calendar',
    ];

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/autoactions';
    }
}