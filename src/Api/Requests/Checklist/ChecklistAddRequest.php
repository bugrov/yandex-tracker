<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Checklist;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/checklistItems
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/add-checklist-item
 *
 * @method ChecklistAddRequest text(string $text) Текст пункта. Обязательное
 * @method ChecklistAddRequest checked(bool $isChecked) Отметка о выполнении пункта
 * @method ChecklistAddRequest assignee(string $assignee) Идентификатор или логин пользователя, который является исполнителем пункта чеклиста
 * @method ChecklistAddRequest deadline(array $deadlineArray) Дедлайн пункта чеклиста
 */
class ChecklistAddRequest extends ChecklistRequest
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
        'text',
        'checked',
        'assignee',
        'deadline',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/checklistItems';
    }
}