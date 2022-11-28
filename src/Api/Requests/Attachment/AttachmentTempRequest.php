<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Attachment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/attachments/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/temp-attachment
 *
 * @method AttachmentTempRequest filename(string $newName) Новое имя файла, с которым он будет храниться на сервере
 */
class AttachmentTempRequest extends AttachmentRequest
{
    const ACTION = 'attachments';
    const METHOD = Client::METHOD_POST;

    /**
     * @var bool Устанавливать заголовок Content-Type: multipart/form-data
     */
    protected bool $multipartRequest = true;

    /**
     * @var array|string[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    /**
     * @var array|string[] get-параметры, доступные для запроса
     */
    protected array $queryParams = [
        'filename',
    ];

    public function __construct($file)
    {
        $this->data['bodyParams'] = $file;
        $this->url = self::ACTION.'/';
    }
}