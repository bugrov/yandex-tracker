<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Bulk\{BulkMoveIssuesRequest,
    BulkRequest,
    BulkTransitionIssuesRequest,
    BulkUpdateIssuesRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с пакетными операциями. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method BulkMoveIssuesRequest moveIssues() Массовый перенос задач в другую очередь
 * @method BulkUpdateIssuesRequest updateIssues() Массовое редактирование задач
 * @method BulkTransitionIssuesRequest transitionIssues() Массовое изменение статуса задач
 */
class Bulk extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с пакетными операциями
     */
    protected array $methodsList = [
        'moveIssues',
        'updateIssues',
        'transitionIssues',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return BulkRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Bulk\\'.'Bulk'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}