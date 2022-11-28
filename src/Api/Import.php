<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Import\{ImportAttachCommentFileRequest,
    ImportAttachIssueFileRequest,
    ImportCommentsRequest,
    ImportLinksRequest,
    ImportRequest,
    ImportTicketRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с импортом. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method ImportTicketRequest ticket() Импортировать задачу
 * @method ImportAttachIssueFileRequest attachIssueFile(string $issueId, string|resource $file) Прикрепить файл к задаче
 * @method ImportAttachCommentFileRequest attachCommentFile(string $issueId, string|int $commentId, string|resource $file) Прикрепить файл к комментарию
 * @method ImportCommentsRequest comments(string $issueId) Импортировать комментарии
 * @method ImportLinksRequest links(string $issueId) Импортировать связи
 */
class Import extends TrackerAction
{
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
     * Связываемая задача является клоном текущей
     */
    const REL_CLONE = 'clone';
    /**
     * Текущая задача является клоном связанной
     */
    const REL_ORIGINAL = 'original';

    /**
     * @var array|string[] Запросы, доступные для работы с импортом
     */
    protected array $methodsList = [
        'ticket',
        'attachIssueFile',
        'attachCommentFile',
        'comments',
        'links',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ImportRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Import\\'.'Import'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}