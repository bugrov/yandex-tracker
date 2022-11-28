<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/boards/$boardId/columns/$columnId
 *
 * @see https://cloud.yandex.ru/docs/tracker/patch-column
 *
 * @method BoardPatchColumnRequest name(string $name) Название колонки
 * @method BoardPatchColumnRequest statuses(array $statusesList) Массив содержит ключи возможных статусов задач, которые попадут в колонку
 */
class BoardPatchColumnRequest extends BoardRequest
{
    const ACTION = 'boards';
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
        'statuses',
    ];

    public function __construct(int $boardId, int $columnId)
    {
        $this->url = self::ACTION.'/'.$boardId.'/columns/'.$columnId;
    }
}