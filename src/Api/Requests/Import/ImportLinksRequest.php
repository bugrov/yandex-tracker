<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Import;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/links/_import
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/import/import-links
 *
 * @method ImportLinksRequest relationship(string $type) Тип связи между задачами. Обязательное
 * @method ImportLinksRequest issue(string $issue) Идентификатор или ключ связываемой задачи. Обязательное
 * @method ImportLinksRequest createdAt(string $date) Дата и время создания связи. формате YYYY-MM-DDThh:mm:ss.sss±hhmm. Обязательное
 * @method ImportLinksRequest createdBy(string|int $user) Логин или идентификатор создателя связи. Обязательное
 * @method ImportLinksRequest updatedAt(string $date) Дата и время последнего изменения связи. формате YYYY-MM-DDThh:mm:ss.sss±hhmm
 * @method ImportLinksRequest updatedBy(string|int $user) Логин или идентификатор пользователя, который редактировал связь последним
 */
class ImportLinksRequest extends ImportRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_POST;

    /**
     * @var array|string[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'relationship',
        'issue',
        'createdAt',
        'createdBy',
        'updatedAt',
        'updatedBy',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/links/_import';
    }
}