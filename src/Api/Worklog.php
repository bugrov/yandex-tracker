<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Worklog\{WorklogDeleteRequest,
    WorklogGetRequest,
    WorklogIssueRequest,
    WorklogNewRequest,
    WorklogPatchRequest,
    WorklogRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с учетом времени. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method WorklogNewRequest new(string $issueId) Добавить запись о затраченном времени
 * @method WorklogPatchRequest patch(string $issueId, string|int $worklogId) Редактировать запись о затраченном времени
 * @method WorklogDeleteRequest delete(string $issueId, string|int $worklogId) Удалить запись о затраченном времени
 * @method WorklogIssueRequest issue(string $issueId) Получить все записи о затраченном времени по задаче
 * @method WorklogGetRequest get() Отобрать записи о затраченном времени по параметрам
 */
class Worklog extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с учетом времени
     */
    protected array $methodsList = [
        'new',
        'patch',
        'delete',
        'issue',
        'get',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return WorklogRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Worklog\\'.'Worklog'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}