<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Board\{BoardDeleteColumnRequest,
    BoardDeleteRequest,
    BoardGetAllRequest,
    BoardGetColumnRequest,
    BoardGetColumnsRequest,
    BoardGetRequest,
    BoardGetSprintRequest,
    BoardGetSprintsRequest,
    BoardPatchColumnRequest,
    BoardPatchRequest,
    BoardPostColumnRequest,
    BoardPostRequest,
    BoardPostSprintRequest,
    BoardRequest};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с досками. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method BoardGetAllRequest getAll() Получить параметры всех досок
 * @method BoardGetRequest get(int $boardId) Получить параметры доски
 * @method BoardPostRequest post() Создать доску
 * @method BoardPatchRequest patch(int $boardId) Редактировать доску
 * @method BoardDeleteRequest delete(int $boardId) Удалить доску
 * @method BoardGetColumnsRequest getColumns(int $boardId) Получить параметры всех колонок
 * @method BoardGetColumnRequest getColumn(int $boardId, int $columnId) Получить параметры колонки
 * @method BoardPostColumnRequest postColumn(int $boardId) Создать колонку
 * @method BoardPatchColumnRequest patchColumn(int $boardId, int $columnId) Редактировать колонку
 * @method BoardDeleteColumnRequest deleteColumn(int $boardId, int $columnId) Удалить колонку
 * @method BoardGetSprintsRequest getSprints(int $boardId) Получить все спринты доски
 * @method BoardGetSprintRequest getSprint(string $sprintId) Получить спринт
 * @method BoardPostSprintRequest postSprint() Создать спринт
 */
class Board extends TrackerAction
{
    /**
     * Тип доски - Простая
     */
    const BOARD_TYPE_DEFAULT = 'default';
    /**
     * Тип доски - Скрам
     */
    const BOARD_TYPE_SCRUM = 'scrum';
    /**
     * Тип доски - Канбан
     */
    const BOARD_TYPE_KANBAN = 'kanban';

    /**
     * @var array|string[] Запросы, доступные для работы с досками
     */
    protected array $methodsList = [
        'getAll',
        'get',
        'post',
        'patch',
        'delete',
        'getColumns',
        'getColumn',
        'postColumn',
        'patchColumn',
        'deleteColumn',
        'getSprints',
        'getSprint',
        'postSprint',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return BoardRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Board\\'.'Board'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}