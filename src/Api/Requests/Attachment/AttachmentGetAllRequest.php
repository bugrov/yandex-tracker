<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Attachment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/attachments
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-attachments-list
 */
class AttachmentGetAllRequest extends AttachmentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/attachments';
    }
}