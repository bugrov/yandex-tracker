<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Comment\{CommentAddRequest,
    CommentDeleteRequest,
    CommentEditRequest,
    CommentGetRequest,
    CommentRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с комментариями. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method CommentAddRequest add(string $issueId) Добавить комментарий
 * @method CommentGetRequest get(string $issueId) Получить комментарии к задаче
 * @method CommentEditRequest edit(string $issueId, string|int $commentId) Редактировать комментарий
 * @method CommentDeleteRequest delete(string $issueId, string|int $commentId) Удалить комментарий
 */
class Comment extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с комментариями
     */
    protected array $methodsList = [
        'add',
        'get',
        'edit',
        'delete',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return CommentRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Comment\\'.'Comment'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}