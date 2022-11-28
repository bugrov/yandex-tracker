<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Macros\{MacrosDeleteRequest,
    MacrosGetAllRequest,
    MacrosGetRequest,
    MacrosPatchRequest,
    MacrosPostRequest,
    MacrosRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с макросами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method MacrosGetAllRequest getAll(string $queueId) Получить макросы очереди
 * @method MacrosGetRequest get(string $queueId, string $macrosId) Получить макрос
 * @method MacrosPostRequest post(string $queueId) Создать макрос
 * @method MacrosPatchRequest patch(string $queueId, string $macrosId) Редактировать макрос
 * @method MacrosDeleteRequest delete(string $queueId, string $macrosId) Удалить макрос
 */
class Macros extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с макросами
     */
    protected array $methodsList = [
        'getAll',
        'get',
        'post',
        'patch',
        'delete',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return MacrosRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Macros\\'.'Macros'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}