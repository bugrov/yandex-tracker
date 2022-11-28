<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Component\{ComponentGetAllRequest, ComponentRequest};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с компонентами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method ComponentGetAllRequest getAll() Получить список компонентов
 */
class Component extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с компонентами
     */
    protected array $methodsList = [
        'getAll',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ComponentRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Component\\'.'Component'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}