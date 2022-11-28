<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Attachment;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/issues/$issueId/attachments/$attachmentId/$filename
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/get-attachment
 */
class AttachmentGetRequest extends AttachmentRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_GET;

    public function __construct(string $issueId, string $attachmentId, string $filename)
    {
        $this->url = self::ACTION.'/'.$issueId.'/attachments/'.$attachmentId.'/'.$filename;
    }
}