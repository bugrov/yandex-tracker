<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/issues/$issueId/worklog/$worklogId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/patch-worklog
 *
 * @method WorklogPatchRequest duration(string $time) Затраченное время в формате PnYnMnDTnHnMnS, PnW в соответствии с ISO 8601. Обязательное
 * @method WorklogPatchRequest comment(string $text) Текст комментария к записи
 */
class WorklogPatchRequest extends WorklogRequest
{
    const ACTION = 'issues';
    const METHOD = Client::METHOD_PATCH;

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
        'duration',
        'comment',
    ];

    public function __construct(string $issueId, string $worklogId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/worklog/'.$worklogId;
    }
}