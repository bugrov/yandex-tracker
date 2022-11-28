<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Attachment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к DELETE /v2/issues/$issue-id/attachments/$attachmentId/
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-attachment
 */
class AttachmentDeleteRequest extends AttachmentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_DELETE;

    public function __construct(string $issueId, string $attachmentId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/attachments/'.$attachmentId.'/';
    }
}