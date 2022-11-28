<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Macros;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/macros
 *
 * @see https://cloud.yandex.ru/docs/tracker/post-macros
 *
 * @method MacrosPostRequest name(string $name) Название макроса. Обязательное
 * @method MacrosPostRequest body(string|array $body) Сообщение, которое будет создано при выполнении макроса
 * @method MacrosPostRequest fieldChanges(array $issueFields) Массив с информацией о полях задачи, изменения которых запустит макрос
 */
class MacrosPostRequest extends MacrosRequest
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
        'body',
        'fieldChanges',
    ];

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/macros';
    }
}