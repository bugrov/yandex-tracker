<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Project\{ProjectDeleteRequest,
    ProjectGetAllRequest,
    ProjectGetQueuesRequest,
    ProjectGetRequest,
    ProjectRequest,
    ProjectCreateRequest,
    ProjectUpdateRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с проектами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method ProjectCreateRequest create() Создать проект
 * @method ProjectGetRequest get(int $projectId) Получить параметры проекта
 * @method ProjectGetAllRequest getAll() Получить список всех проектов
 * @method ProjectGetQueuesRequest getQueues(int $projectId) Получить список очередей проекта
 * @method ProjectUpdateRequest update(int $projectId) Изменить проект
 * @method ProjectDeleteRequest delete(int $projectId) Удалить проект
 */
class Project extends TrackerAction
{
    /**
     * Черновик
     */
    const STAGE_DRAFT = 'DRAFT';
    /**
     * В работе
     */
    const STAGE_IN_PROGRESS = 'IN_PROGRESS';
    /**
     * Запущен
     */
    const STAGE_LAUNCHED = 'LAUNCHED';
    /**
     * Отложен
     */
    const STAGE_POSTPONED = 'POSTPONED';

    /**
     * Очереди проекта
     */
    const FIELD_QUEUES = 'queues';
    /**
     * Все параметры очереди
     */
    const FIELD_ALL = 'all';
    /**
     * Все проекты организации
     */
    const FIELD_PROJECTS = 'projects';
    /**
     * Компоненты очереди
     */
    const FIELD_COMPONENTS = 'components';
    /**
     * Версии очереди
     */
    const FIELD_VERSIONS = 'versions';
    /**
     * Типы задач очереди
     */
    const FIELD_TYPES = 'types';
    /**
     * Участники команды очереди
     */
    const FIELD_TEAM = 'team';
    /**
     * Жизненные циклы очереди и их типы задач
     */
    const FIELD_WORKFLOWS = 'workflows';
    /**
     * Обязательные поля очереди
     */
    const FIELD_FIELDS = 'fields';
    /**
     * Поля в уведомлениях о задачах очереди
     */
    const FIELD_NOTIFICATIONS = 'notification_fields';
    /**
     * Настройки задач очереди
     */
    const FIELD_ISSUE_CONFIG = 'issue_types_config';
    /**
     * Настройки интеграций очереди
     */
    const FIELD_ENABLED_FEATURES = 'enabled_features';
    /**
     * Информация о почтовом ящике очереди
     */
    const FIELD_SIGNATURE_SETTINGS = 'signature_settings';

    /**
     * @var array|string[] Запросы, доступные для работы с проектами
     */
    protected array $methodsList = [
        'create',
        'get',
        'getAll',
        'getQueues',
        'update',
        'delete',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ProjectRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Project\\'.'Project'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}