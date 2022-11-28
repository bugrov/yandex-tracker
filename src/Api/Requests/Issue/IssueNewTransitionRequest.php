<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Issue;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/transitions/$transitionId/_execute
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/new-transition
 *
 * @method IssueNewTransitionRequest comment(string $text) Комментарий к задаче
 */
class IssueNewTransitionRequest extends IssueRequest
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
     * @var bool Отменить проверку на существование магического метода
     */
    protected bool $skipMethodCheck = true;

    public function __construct(string $issueId, string $transitionId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/transitions/'.$transitionId.'/_execute';
    }
}