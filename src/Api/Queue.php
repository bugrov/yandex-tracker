<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Queue\{QueueCreateAutoActionRequest,
    QueueCreateRequest,
    QueueCreateTriggerRequest,
    QueueDeleteRequest,
    QueueDeleteTagRequest,
    QueueGetAllRequest,
    QueueGetAutoActionRequest,
    QueueGetFieldsRequest,
    QueueGetRequest,
    QueueGetTriggerRequest,
    QueueGetVersionsRequest,
    QueueRequest,
    QueueRestoreRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с очередями. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method QueueCreateRequest create() Создать очередь
 * @method QueueGetRequest get(string|int $queueId) Получить параметры очереди
 * @method QueueGetAllRequest getAll() Получить список очередей
 * @method QueueGetVersionsRequest getVersions(string|int $queueId) Получить версии очереди
 * @method QueueGetFieldsRequest getFields(string|int $queueId) Получить обязательные поля очереди
 * @method QueueDeleteRequest delete(string|int $queueId) Удалить очередь
 * @method QueueRestoreRequest restore(string|int $queueId) Восстановить очередь
 * @method QueueDeleteTagRequest deleteTag(string|int $queueId) Удалить тег из очереди
 * @method QueueCreateAutoActionRequest createAutoAction(string|int $queueId) Создать автодействие
 * @method QueueGetAutoActionRequest getAutoAction(string|int $queueId, int $autoActionId) Получить параметры автодействия
 * @method QueueCreateTriggerRequest createTrigger(string|int $queueId) Создать триггер
 * @method QueueGetTriggerRequest getTrigger(string|int $queueId, int $triggerId) Получить параметры триггера
 */
class Queue extends TrackerAction
{
    /**
     * workflow Support
     */
    const WORKFLOW_SUPPORT = 'basicSupportPresetWorkflow';
    /**
     * workflow Software development
     */
    const WORKFLOW_SOFTWARE_DEV = 'developmentPresetWorkflow';
    /**
     * workflow Documents approval
     */
    const WORKFLOW_DOCUMENTS_APPROVAL = 'documentAcceptancePresetWorkflow';
    /**
     * workflow Goal management
     */
    const WORKFLOW_GOAL_MANAGEMENT = 'goalsManagmentPresetWorkflow';
    /**
     * workflow Human Resources
     */
    const WORKFLOW_HUMAN_RESOURCES = 'hrPresetWorkflow';
    /**
     * workflow Development with Kanban
     */
    const WORKFLOW_DEV_WITH_KANBAN = 'kanbanDevelopmentPresetWorkflow';
    /**
     * workflow Manufacture
     */
    const WORKFLOW_MANUFACTURE = 'manufacturingPresetWorkflow';
    /**
     * workflow Marketing
     */
    const WORKFLOW_MARKETING = 'marketingPresetWorkflow';
    /**
     * workflow Outsource software development
     */
    const WORKFLOW_OUTSOURCE_SOFTWARE_DEV = 'outsourceDevelopmentPresetWorkflow';
    /**
     * workflow Quick start
     */
    const WORKFLOW_QUICK_START = 'quickStartV2PresetWorkflow';
    /**
     * workflow Recruiting
     */
    const WORKFLOW_RECRUITING = 'recruitmentPresetWorkflow';
    /**
     * workflow Development with Scrum
     */
    const WORKFLOW_DEV_WITH_SCRUM = 'scrumDevelopmentPresetWorkflow';
    /**
     * workflow Offering services
     */
    const WORKFLOW_OFFERING_SERVICES = 'serviceProvisionPresetWorkflow';
    /**
     * workflow 2 line support
     */
    const WORKFLOW_TWO_LINE_SUPPORT = 'tieredSupportPresetWorkflow';

    /**
     * Все дополнительные поля очереди
     */
    const FIELD_ALL = 'all';
    /**
     * Проекты очереди
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
     * Типы задач
     */
    const FIELD_TYPES = 'types';
    /**
     * Список участников команды очереди
     */
    const FIELD_TEAM = 'team';
    /**
     * Список жизненных циклов
     */
    const FIELD_WORKFLOWS = 'workflows';
    /**
     * Обязательные поля очереди
     */
    const FIELD_FIELDS = 'fields';
    /**
     * Настройки типов задач очереди
     */
    const FIELD_ISSUE_CONFIG = 'issueTypesConfig';

    /**
     * @var array|string[] Запросы, доступные для работы с очередями
     */
    protected array $methodsList = [
        'create',
        'get',
        'getAll',
        'getVersions',
        'getFields',
        'delete',
        'restore',
        'deleteTag',
        'createAutoAction',
        'getAutoAction',
        'createTrigger',
        'getTrigger',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return QueueRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Queue\\'.'Queue'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}