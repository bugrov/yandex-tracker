<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Board;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/boards/
 *
 * @see https://cloud.yandex.ru/docs/tracker/post-board
 *
 * @method BoardPostRequest name(string $name) Название доски. Обязательное
 * @method BoardPostRequest defaultQueue(array|string|int $queue) Очередь. Обязательное
 * @method BoardPostRequest boardType(string $type) Тип доски. Возможные типы досок: default, scrum, kanban
 * @method BoardPostRequest filter(array $filterList) Массив с информацией об условиях фильтра, с помощью которого отбираются задачи для доски
 * @method BoardPostRequest orderBy(string $field) Ключ поля для сортировки задач на доске
 * @method BoardPostRequest orderAsc(bool $field) Направление сортировки (true - по возрастанию, false - по убыванию)
 * @method BoardPostRequest query(string $filter) Параметры фильтра, с помощью которого отбираются задачи для доски (на языке запросов Яндекс.Трекера)
 * @method BoardPostRequest useRanking(bool $use) Возможность менять порядок задач на доске (разрешено/запрещено)
 * @method BoardPostRequest country(array $countryInfo) Массив с информацией о стране. Чтобы получить список стран, используйте запрос:<br><code>$api->country()->getAll()->send();</code>
 */
class BoardPostRequest extends BoardRequest
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
        'defaultQueue',
        'boardType',
        'filter',
        'orderBy',
        'orderAsc',
        'query',
        'useRanking',
        'country',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/';
    }
}