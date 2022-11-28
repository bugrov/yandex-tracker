<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Project;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PUT /v2/projects/$projectId?version=номер версии
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/projects/update-project
 *
 * @method ProjectUpdateRequest version(int $versionNumber) Версия проекта. Изменения вносятся только в текущую версию проекта. Обязательное
 * @method ProjectUpdateRequest expand(string $field) Дополнительные поля, которые будут включены в ответ. Доступные: queues
 *
 * @method ProjectUpdateRequest queues(string $issueQueue) Задачи, которые планируется включать в проект
 * @method ProjectUpdateRequest name(string $name) Название проекта
 * @method ProjectUpdateRequest description(string $text) Описание проекта. Параметр не отображается в интерфейсе Tracker
 * @method ProjectUpdateRequest lead(string|int $lead) Идентификатор или логин исполнителя проекта
 * @method ProjectUpdateRequest status(string $stage) Этап, на котором находится проект
 * @method ProjectCreateRequest startDate(string $date) Дата начала проекта в формате YYYY-MM-DD
 * @method ProjectUpdateRequest endDate(string $date) Дата завершения проекта в формате YYYY-MM-DD
 */
class ProjectUpdateRequest extends ProjectRequest
{
    const ACTION = 'projects';
    const METHOD = Client::METHOD_PUT;

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
        'version',
        'expand',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'queues',
        'name',
        'description',
        'lead',
        'status',
        'startDate',
        'endDate',
    ];

    public function __construct(int $projectId)
    {
        $this->url = self::ACTION.'/'.$projectId;
    }
}