<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Issue\{IssueChangelogRequest,
    IssueClearSearchRequest,
    IssueCreateRequest,
    IssueDeleteLinkRequest,
    IssueEditRequest,
    IssueGetCountRequest,
    IssueGetLinksRequest,
    IssueGetPrioritiesRequest,
    IssueGetRequest,
    IssueGetTransitionsRequest,
    IssueLinkRequest,
    IssueMoveRequest,
    IssueNewTransitionRequest,
    IssueRequest,
    IssueSearchRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с задачами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method IssueMoveRequest move(string $issueId) Перенести задачу в другую очередь
 * @method IssueGetRequest get(string $issueId) Получить параметры задачи
 * @method IssueEditRequest edit(string $issueId) Редактировать задачу
 * @method IssueCreateRequest create() Создать задачу
 * @method IssueGetCountRequest getCount() Узнать количество задач
 * @method IssueSearchRequest search() Узнать количество задач
 * @method IssueClearSearchRequest clearSearch(array $tokens) Освободить ресурсы просмотра прокрутки.<br><code>$tokens - массив пар srollId => scrollToken</code>
 * @method IssueGetPrioritiesRequest getPriorities() Получить приоритеты
 * @method IssueGetTransitionsRequest getTransitions(string $issueId) Получить переходы
 * @method IssueNewTransitionRequest newTransition(string $issueId, string $transitionId) Выполнить переход в статус
 * @method IssueChangelogRequest changelog(string $issueId) Получить историю изменений задачи
 * @method IssueLinkRequest link(string $issueId) Связать задачи
 * @method IssueGetLinksRequest getLinks(string $issueId) Получить связи задачи
 * @method IssueDeleteLinkRequest deleteLink(string $issueId, int $linkId) Удалить связь с задачей
 */
class Issue extends TrackerAction
{
    /**
     * Переходы по жизненному циклу
     */
    const FIELD_TRANSITIONS = 'transitions';
    /**
     * Вложения
     */
    const FIELD_ATTACHMENTS = 'attachments';
    /**
     * Комментарии
     */
    const FIELD_COMMENTS = 'comments';
    /**
     * Воркфлоу задачи
     */
    const FIELD_WORKFLOW = 'workflow';
    /**
     * Используется указанная в запросе сортировка
     */

    const SCROLL_TYPE_SORTED = 'sorted';
    /**
     * Сортировка не используется
     */
    const SCROLL_TYPE_UNSORTED = 'unsorted';

    /**
     * Простая связь
     */
    const REL_RELATES = 'relates';
    /**
     * Текущая задача является блокером
     */
    const REL_IS_DEPENDENT_BY = 'is dependent by';
    /**
     * Текущая задача зависит от связываемой
     */
    const REL_DEPENDS_ON = 'depends on';
    /**
     * Текущая задача является подзадачей связываемой
     */
    const REL_IS_SUBTASK_FOR = 'is subtask for';
    /**
     * Текущая задача является родительской для связываемой задачи
     */
    const REL_IS_PARENT_TASK_FOR = 'is parent task for';
    /**
     * Текущая задача дублирует связываемую
     */
    const REL_DUPLICATES = 'duplicates';
    /**
     * Связываемая задача дублирует текущую
     */
    const REL_IS_DUPLICATED_BY = 'is duplicated by';
    /**
     * Текущая задача является эпиком связываемой
     */
    const REL_IS_EPIC_OF = 'is epic of';
    /**
     * Связываемая задача является эпиком текущей
     */
    const REL_HAS_EPIC = 'has epic';

    /**
     * @var array|string[] Запросы, доступные для работы с задачами
     */
    protected array $methodsList = [
        'get',
        'edit',
        'create',
        'move',
        'getCount',
        'search',
        'clearSearch',
        'getPriorities',
        'getTransitions',
        'newTransition',
        'changelog',
        'link',
        'getLinks',
        'deleteLink',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return IssueRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Issue\\'.'Issue'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}