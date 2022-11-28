<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Checklist\{ChecklistAddRequest,
    ChecklistDeleteRequest,
    ChecklistEditRequest,
    ChecklistGetRequest,
    ChecklistRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с чеклистами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method ChecklistAddRequest add(string $issueId) Создать чеклист или добавить в него пункты
 * @method ChecklistGetRequest get(string $issueId) Получить параметры чеклиста
 * @method ChecklistEditRequest edit(string $issueId, string $checklistId) Редактировать чеклист
 * @method ChecklistDeleteRequest delete(string $issueId) Удалить чеклист
 */
class Checklist extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с чеклистами
     */
    protected array $methodsList = [
        'add',
        'get',
        'edit',
        'delete',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ChecklistRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Checklist\\'.'Checklist'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}