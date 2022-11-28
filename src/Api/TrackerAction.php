<?php

namespace BugrovWeb\YandexTracker\Api;

/**
 * Обертка над классами действий
 */
abstract class TrackerAction
{
    /**
     * @var array Запросы, доступные для определенного действия
     */
    protected array $methodsList = [];

    abstract public function __call(string $name, array $arguments);
}