<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Project;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/projects/$projectId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/projects/get-project
 *
 * @method ProjectGetRequest expand(string $field) Дополнительные поля, которые будут включены в ответ. Доступные: queues
 */
class ProjectGetRequest extends ProjectRequest
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

    public function __construct(int $projectId)
    {
        $this->url = self::ACTION.'/'.$projectId;
    }
}