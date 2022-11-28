<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/sprints
 *
 * @see https://cloud.yandex.ru/docs/tracker/post-sprint
 *
 * @method BoardPostSprintRequest name(string $name) Название спринта. Обязательное
 * @method BoardPostSprintRequest board(string $boardId) id доски, к задачам которой относится спринт. Обязательное
 * @method BoardPostSprintRequest startDate(string $date) Дата начала спринта в формате: YYYY-MM-DD. Обязательное
 * @method BoardPostSprintRequest endDate(string $date) Дата окончания спринта в формате: YYYY-MM-DD. Обязательное
 */
class BoardPostSprintRequest extends BoardRequest
{
    const ACTION = 'sprints';
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
        'board',
        'startDate',
        'endDate',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}