<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\User\{UserGetAllRequest,
    UserGetInfoRequest,
    UserGetRequest,
    UserRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с пользователями. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method UserGetInfoRequest getInfo() Получить информацию о текущем пользователе
 * @method UserGetAllRequest getAll() Получить информацию о пользователях
 * @method UserGetRequest get(string $uid) Получить информацию о пользователе
 */
class User extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с пользователями
     */
    protected array $methodsList = [
        'getInfo',
        'getAll',
        'get',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return UserRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\User\\'.'User'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}