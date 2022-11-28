<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/fields/$fieldId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/patch-issue-field-name
 *
 * @method FieldPatchNameRequest version(string|int $fieldVersion) Версия поля задачи. Обязательное
 *
 * @method FieldPatchNameRequest name(array $names) Массив с информацией об имени поля задачи. Ключи: en (на английском), ru (на русском) Обязательное
 */
class FieldPatchNameRequest extends FieldRequest
{
    const ACTION = 'fields';
    const METHOD = Client::METHOD_PATCH;

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
        'version',
    ];

    /**
     * @var array|string[] Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [
        'name',
    ];

    public function __construct(string $fieldId)
    {
        $this->url = self::ACTION.'/'.$fieldId;
    }
}