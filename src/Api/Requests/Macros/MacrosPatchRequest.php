<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Macros;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/queues/$queueId/macros/$macrosId
 *
 * @see https://cloud.yandex.ru/docs/tracker/patch-macros
 *
 * @method MacrosPatchRequest name(string $name) Название макроса. Обязательное
 * @method MacrosPatchRequest body(string|array $body) Сообщение, которое будет создано при выполнении макроса
 * @method MacrosPatchRequest fieldChanges(array $issueFields) Массив с информацией о полях задачи, изменения которых запустит макрос
 */
class MacrosPatchRequest extends MacrosRequest
{
    const ACTION = 'queues';
    const METHOD = Client::METHOD_PATCH;

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

    public function __construct(string $queueId, string $macrosId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/macros/'.$macrosId;
    }
}