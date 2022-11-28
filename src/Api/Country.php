<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Country\{CountryGetAllRequest, CountryRequest};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы со странами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method CountryGetAllRequest getAll() Получить список стран
 */
class Country extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы со странами
     */
    protected array $methodsList = [
        'getAll',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return CountryRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Country\\'.'Country'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}