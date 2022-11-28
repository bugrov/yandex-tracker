<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Import;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/attachments/_import?filename={filename}&createdAt={createdAt}&createdBy={createdBy}
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/import/import-attachments
 *
 * @method ImportAttachIssueFileRequest filename(string $fileName) Имя файла, максимальная длина - 255 символов. Обязательное
 * @method ImportAttachIssueFileRequest createdAt(string $date) Дата и время прикрепления файла в формате YYYY-MM-DDThh:mm:ss.sss±hhmm. Обязательное
 * @method ImportAttachIssueFileRequest createdBy(string $user) Логин или идентификатор автора прикрепленного файла. Обязательное
 */
class ImportAttachIssueFileRequest extends ImportRequest
{
    const ACTION = 'issues';
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
        'createdAt',
        'createdBy',
    ];

    public function __construct(string $issueId, $file)
    {
        $this->data['bodyParams'] = $file;
        $this->url = self::ACTION.'/'.$issueId.'/attachments/_import';
    }
}