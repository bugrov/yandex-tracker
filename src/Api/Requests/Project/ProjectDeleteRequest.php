<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Project;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/projects/$projectId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/projects/delete-project
 */
class ProjectDeleteRequest extends ProjectRequest
{
    const ACTION = 'projects';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(int $projectId)
    {
        $this->url = self::ACTION.'/'.$projectId;
    }
}