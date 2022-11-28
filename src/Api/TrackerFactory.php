<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Фабрика, выдающая экземпляр TrackerAction
 */
class TrackerFactory
{
    /**
     * @var array|string[] Доступные действия в API
     */
    protected array $availableMethods = [
        'issue',
        'checklist',
        'project',
        'comment',
        'macros',
        'external',
        'attachment',
        'queue',
        'board',
        'country',
        'component',
        'import',
        'bulk',
        'worklog',
        'field',
        'user',
    ];

    /**
     * Конструктор TrackerFactory
     *
     * @param string $name
     *
     * @return TrackerAction
     *
     * @throws TrackerConstructorException
     */
    public function createInstance(string $name): TrackerAction
    {
        if (!in_array($name, $this->availableMethods)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\'.ucfirst($name);

        try {
            return new $className;
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}