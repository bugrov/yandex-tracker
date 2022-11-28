<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Attachment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/thumbnails/$attachmentId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-attachment-preview
 */
class AttachmentGetPreviewRequest extends AttachmentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId, string $attachmentId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/thumbnails/'.$attachmentId;
    }
}