<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Фасад для работы с методами, реализуюзими API Яндекс.Трекера
 *
 * @method Issue issue() Класс для работы с задачами
 * @method Checklist checklist() Класс для работы с чеклистами
 * @method Project project() Класс для работы с проектами
 * @method Comment comment() Класс для работы с комментариями
 * @method Macros macros() Класс для работы с макросами
 * @method External external() Класс для работы с внешними приложениями
 * @method Attachment attachment() Класс для работы с прикрепленными файлами
 * @method Queue queue() Класс для работы с очередями
 * @method Board board() Класс для работы с досками
 * @method Country country() Класс для работы со странами
 * @method Component component() Класс для работы с компонентами
 * @method Import import() Класс для работы с импортом
 * @method Bulk bulk() Класс для работы с пакетными операциями
 * @method Worklog worklog() Класс для работы с учетом времени
 * @method Field field() Класс для работы с полями задач
 * @method User user() Класс для работы с пользователями
 */

class Tracker
{
    public function __construct(string $token, string $xOrgId)
    {
        Client::getInstance()->setToken($token);
        Client::getInstance()->setOrgId($xOrgId);
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return TrackerAction
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments): TrackerAction
    {
        return $this->getTrackerFactory()->createInstance($name);
    }

    /**
     * Геттер для фабрики TrackerFactory
     *
     * @return TrackerFactory
     */
    protected function getTrackerFactory(): TrackerFactory
    {
        return new TrackerFactory();
    }
}