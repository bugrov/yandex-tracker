<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Queue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/create-queue
 *
 * @method QueueCreateRequest key(string $queueKey) Ключ очереди. Обязательное
 * @method QueueCreateRequest name(string $name) Название очереди. Обязательное
 * @method QueueCreateRequest lead(string $login) Логин или идентификатор владельца очереди. Обязательное
 * @method QueueCreateRequest defaultType(string $type) Идентификатор или ключ типа задач по умолчанию. Обязательное
 * @method QueueCreateRequest defaultPriority(string $priority) Идентификатор или ключ приоритета задач по умолчанию. Обязательное
 * @method QueueCreateRequest issueTypesConfig(array $configList) Массив с настройками типов задач очереди. Обязательное
 */
class QueueCreateRequest extends QueueRequest
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
        'key',
        'name',
        'lead',
        'defaultType',
        'defaultPriority',
        'issueTypesConfig',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/';
    }
}