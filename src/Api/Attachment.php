<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Attachment\{AttachmentDeleteRequest,
    AttachmentGetAllRequest,
    AttachmentGetPreviewRequest,
    AttachmentGetRequest,
    AttachmentPostRequest,
    AttachmentRequest,
    AttachmentTempRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с прикрепленными файлами. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method AttachmentGetAllRequest getAll(string $issueId) Получить список прикрепленных файлов
 * @method AttachmentGetRequest get(string $issueId, string|int $attachmentId, string $filename) Скачать файл
 * @method AttachmentGetPreviewRequest getPreview(string $issueId, string|int $attachmentId) Скачать миниатюру
 * @method AttachmentPostRequest post(string $issueId, string|resource $file) Прикрепить файл
 * @method AttachmentTempRequest temp(string|resource $file) Загрузить временный файл
 * @method AttachmentDeleteRequest delete(string $issueId, string|int $attachmentId) Удалить файл
 */
class Attachment extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с прикрепленными файлами
     */
    protected array $methodsList = [
        'getAll',
        'get',
        'getPreview',
        'post',
        'temp',
        'delete',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return AttachmentRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Attachment\\'.'Attachment'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}