<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/worklog/_search
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-worklog
 *
 * @method WorklogGetRequest perPage(int $count) Количество записей на странице ответа
 * @method WorklogGetRequest page(int $pageNumber) Номер страницы ответа
 *
 * @method WorklogGetRequest createdBy(string $user) Идентификатор или логин автора записи
 * @method WorklogGetRequest createdAt(array|string[] $date) Массив с информацией о времени и дате создания записей. Возможные ключи - from, to
 */
class WorklogGetRequest extends WorklogRequest
{
    const ACTION = 'worklog/_search';
    const METHOD = Client::METHOD_POST;

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
        'perPage',
        'page',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'createdBy',
        'createdAt',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}