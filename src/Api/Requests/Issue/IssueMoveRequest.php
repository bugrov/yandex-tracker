<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/_move?queue=$queueId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/move-issue
 *
 * @method IssueMoveRequest queue(string $queueId) Ключ очереди, в которую необходимо перенести задачу. Обязательный
 * @method IssueMoveRequest notify(bool $notify) Признак уведомления об изменении задачи
 * @method IssueMoveRequest notifyAuthor(bool $notify) Признак уведомления автора задачи
 * @method IssueMoveRequest moveAllFields(bool $move) Перенос версий, компонентов и проектов задачи в новую очередь
 * @method IssueMoveRequest initialStatus(bool $clear) Сброс статуса задачи в начальное значение
 * @method IssueMoveRequest expand(string $field) Дополнительные поля, которые будут включены в ответ
 *
 * @method IssueMoveRequest summary(string $name) Название задачи
 * @method IssueMoveRequest parent(string|array $parent) Родительская задача
 * @method IssueMoveRequest description(string $text) Описание задачи
 * @method IssueMoveRequest sprint(array $sprintArray) Блок с информацией о спринтах
 * @method IssueMoveRequest type(array|string|int $issueType) Тип задачи
 * @method IssueMoveRequest priority(array|string|int $priority) Приоритет задачи
 * @method IssueMoveRequest followers(array $followersArray) Идентификаторы или логины наблюдателей задачи
 */
class IssueMoveRequest extends IssueRequest
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
        'queue',
        'notify',
        'notifyAuthor',
        'moveAllFields',
        'initialStatus',
        'expand',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'summary',
        'parent',
        'description',
        'sprint',
        'type',
        'priority',
        'followers',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/_move';
    }
}