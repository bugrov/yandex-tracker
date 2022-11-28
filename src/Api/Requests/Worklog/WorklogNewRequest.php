<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Worklog;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/worklog
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/new-worklog
 *
 * @method WorklogNewRequest start(string $date) Дата и время начала работы над задачей в формате: YYYY-MM-DDThh:mm:ss.sss±hhmm. Обязательное
 * @method WorklogNewRequest duration(string $isoTime) Затраченное время в формате PnYnMnDTnHnMnS, PnW в соответствии с ISO 8601. Обязательное
 * @method WorklogNewRequest comment(string $text) Текст комментария к записи
 */
class WorklogNewRequest extends WorklogRequest
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
        'start',
        'duration',
        'comment',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/worklog';
    }
}