<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/boards/$boardId/columns/
 *
 * @see https://cloud.yandex.ru/docs/tracker/post-column
 *
 * @method BoardPostColumnRequest name(string $name) Название колонки. Обязательное
 * @method BoardPostColumnRequest statuses(array $statusesList) Массив содержит ключи возможных статусов задач, которые попадут в колонку. Обязательное
 */
class BoardPostColumnRequest extends BoardRequest
{
    const ACTION = 'boards';
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
        'statuses',
    ];

    public function __construct(int $boardId)
    {
        $this->url = self::ACTION.'/'.$boardId.'/columns/';
    }
}