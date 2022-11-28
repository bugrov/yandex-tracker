<?php

namespace BugrovWeb\YandexTracker\Api\Requests\External;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/$issueId/remotelinks
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/add-external-link
 *
 * @method ExternalAddLinkRequest backlink(bool $needRequest) При добавлении связи выполнить запрос из Tracker для создания дублирующей связи во внешнем приложении
 *
 * @method ExternalAddLinkRequest relationship(string $type) Тип связи. Рекомендуем использовать значение RELATES — связан
 * @method ExternalAddLinkRequest key(string $objectKey) Ключ объекта во внешнем приложении
 * @method ExternalAddLinkRequest origin(string $appId) Идентификатор приложения, с объектом которого нужно создать связь
 */
class ExternalAddLinkRequest extends ExternalRequest
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
     * @var array|string[] get-параметры, доступные для запроса
     */
    protected array $queryParams = [
        'backlink',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'relationship',
        'key',
        'origin',
    ];

    public function __construct(string $issueId)
    {
        $this->url = self::ACTION.'/'.$issueId.'/remotelinks';
    }
}