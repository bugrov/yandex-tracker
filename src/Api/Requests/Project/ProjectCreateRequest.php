<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Project;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/projects/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/projects/create-project
 *
 * @method ProjectCreateRequest name(string $name) Название проекта. Обязательное
 * @method ProjectCreateRequest queues(string $issueQueue) Задачи, которые планируется включать в проект. Обязательное
 * @method ProjectCreateRequest description(string $text) Описание проекта. Параметр не отображается в интерфейсе Tracker
 * @method ProjectCreateRequest lead(string|int $lead) Идентификатор или логин исполнителя проекта
 * @method ProjectCreateRequest status(string $stage) Этап, на котором находится проект
 * @method ProjectCreateRequest startDate(string $date) Дата начала проекта в формате YYYY-MM-DD
 * @method ProjectCreateRequest endDate(string $date) Дата завершения проекта в формате YYYY-MM-DD
 */
class ProjectCreateRequest extends ProjectRequest
{
    const ACTION = 'projects';
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
        'queues',
        'description',
        'lead',
        'status',
        'startDate',
        'endDate',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/';
    }
}