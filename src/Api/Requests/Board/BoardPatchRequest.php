<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/boards/$boardId
 *
 * @see https://cloud.yandex.ru/docs/tracker/patch-board
 *
 * @method BoardPatchRequest name(string $name) Название доски
 * @method BoardPatchRequest columns(array $columnsInfo) Массив с информацией о новых колонках доски
 * @method BoardPatchRequest filter(array $filterList) Массив с информацией об условиях фильтра, с помощью которого отбираются задачи для доски
 * @method BoardPatchRequest orderBy(string $field) Ключ поля для сортировки задач на доске
 * @method BoardPatchRequest orderAsc(bool $field) Направление сортировки (true - по возрастанию, false - по убыванию)
 * @method BoardPatchRequest query(string $filter) Параметры фильтра, с помощью которого отбираются задачи для доски (на языке запросов Яндекс.Трекера)
 * @method BoardPatchRequest useRanking(bool $use) Возможность менять порядок задач на доске (разрешено/запрещено)
 * @method BoardPatchRequest country(array $countryInfo) Массив с информацией о стране. Чтобы получить список стран, используйте запрос:<br><code>$api->country()->getAll()->send();</code>
 */
class BoardPatchRequest extends BoardRequest
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
        'columns',
        'filter',
        'orderBy',
        'orderAsc',
        'query',
        'useRanking',
        'country',
    ];

    public function __construct(int $boardId)
    {
        $this->url = self::ACTION.'/'.$boardId;
    }
}