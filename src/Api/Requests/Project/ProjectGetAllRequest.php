<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Project;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/projects
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/projects/get-projects
 *
 * @method ProjectGetAllRequest expand(string $field) Дополнительные поля, которые будут включены в ответ. Доступные: queues
 */
class ProjectGetAllRequest extends ProjectRequest
{
    const ACTION = 'projects';
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

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}