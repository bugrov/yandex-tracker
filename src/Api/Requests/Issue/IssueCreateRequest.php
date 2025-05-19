<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/create-issue
 *
 * @method IssueCreateRequest summary(string $name) Название задачи. Обязательное
 * @method IssueCreateRequest queue(array|string|int $queue) Очередь, в которой нужно создать задачу. Обязательное
 * @method IssueCreateRequest parent(string|array $parent) Родительская задача
 * @method IssueCreateRequest description(string $text) Описание задачи
 * @method IssueCreateRequest markupType(string $text) Тип отображаемой в тексте разметки
 * @method IssueCreateRequest sprint(array $sprintArray) Блок с информацией о спринтах
 * @method IssueCreateRequest type(array|string|int $issueType) Тип задачи
 * @method IssueCreateRequest priority(array|string|int $priority) Приоритет задачи
 * @method IssueCreateRequest followers(array $followersArray) Идентификаторы или логины наблюдателей задачи
 * @method IssueCreateRequest assignee(array|string $assignee) Идентификатор или логин исполнителя задачи
 * @method IssueCreateRequest author(array|string|int $author) Идентификатор или логин автора задачи.
 * @method IssueCreateRequest project(array $project) Блок с информацией о проектах задачи
 * @method IssueCreateRequest unique(string $uniqueField) Поле с уникальным значением, позволяющее предотвратить создание дубликатов задач
 * @method IssueCreateRequest attachmentIds(array|string[] $attachments) Список идентификаторов вложений
 * @method IssueCreateRequest descriptionAttachmentIds(array|string[] $attachments) Список идентификаторов вложений
 * @method IssueCreateRequest tags(string[] $tags) Блок с информацией о тегах
 * @method IssueCreateRequest deadline(string $deadline)  Дата дедлайна задачи в формате RFC3339
 */
class IssueCreateRequest extends IssueRequest
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
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'summary',
        'queue',
        'parent',
        'description',
        'markupType',
        'sprint',
        'type',
        'priority',
        'followers',
        'assignee',
        'author',
        'project',
        'unique',
        'attachmentIds',
        'descriptionAttachmentIds',
        'tags',
        'deadline',
    ];

    public function __construct()
    {
        $this->url = self::ACTION.'/';
    }
}
