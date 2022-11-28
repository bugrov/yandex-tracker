<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Checklist;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/issues/$issueId/checklistItems/$checklistId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/edit-checklist
 *
 * @method ChecklistEditRequest text(string $text) Текст пункта чеклиста. Обязательное
 * @method ChecklistEditRequest checked(bool $isChecked) Признак выполнения пункта чеклиста
 * @method ChecklistEditRequest assignee(string $assignee) Идентификатор или логин пользователя, который является исполнителем пункта чеклиста
 * @method ChecklistEditRequest deadline(array $deadlineArray) Дедлайн пункта чеклиста
 */
class ChecklistEditRequest extends ChecklistRequest
{
    const ACTION = 'issues';
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
        'text',
        'checked',
        'assignee',
        'deadline',
    ];

    public function __construct(string $issueId, string $checklistId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/checklistItems/'.$checklistId;
    }
}