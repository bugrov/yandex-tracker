<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/_search
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/search-issues
 *
 * @method IssueSearchRequest order(string $field) Направление и поле сортировки задач
 * @method IssueSearchRequest expand(string $field) Дополнительные поля, которые будут включены в ответ
 * @method IssueSearchRequest perPage(int $count) Количество задач на странице ответа
 * @method IssueSearchRequest page(int $pageNumber) Номер страницы ответа
 * @method IssueSearchRequest scrollType(string $scrollType) Тип прокрутки
 * @method IssueSearchRequest perScroll(int $count) Максимальное количество задач в ответе с прокруткой
 * @method IssueSearchRequest scrollTTLMillis(int $milliseconds) Время жизни контекста прокрутки и токена scrollToken в миллисекундах
 * @method IssueSearchRequest scrollId(string $scrollId) Идентификатор страницы
 * @method IssueSearchRequest scrollToken(string $scrollToken) Токен, удостоверяющий принадлежность запроса текущему пользователю
 *
 * @method IssueSearchRequest filter(array $filter) Параметры фильтрации задач
 * @method IssueSearchRequest query(string $filter) Фильтр на языке запросов Яндекс.Трекера
 * @method IssueSearchRequest keys(string $issueKeys) Список ключей задач
 * @method IssueSearchRequest queue(string $queue) Очередь задач
 */
class IssueSearchRequest extends IssueRequest
{
    const ACTION = 'issues';
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
        'order',
        'expand',
        'perPage',
        'page',
        'scrollType',
        'perScroll',
        'scrollTTLMillis',
        'scrollId',
        'scrollToken',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'filter',
        'query',
        'expand',
        'keys',
        'queue',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/_search';
    }
}