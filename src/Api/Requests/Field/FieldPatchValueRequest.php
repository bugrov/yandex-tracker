<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/fields/$fieldId
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/patch-issue-field-value
 *
 * @method FieldPatchValueRequest version(string|int $fieldVersion) Версия поля задачи. Обязательное
 *
 * @method FieldPatchValueRequest name(array $names) Название локального поля. Ключи: en (на английском), ru (на русском)
 * @method FieldPatchValueRequest category(string $id) Идентификатор категории поля. Чтобы получить список категорий, используйте запрос:<br><code>$api->field()->getCategories()->send();</code>
 * @method FieldPatchValueRequest order(int $sort) Порядковый номер в списке полей организации
 * @method FieldPatchValueRequest description(string $text) Описание поля
 * @method FieldPatchValueRequest readonly(bool $readonly) Возможность редактировать значение поля
 * @method FieldPatchValueRequest hidden(bool $hidden) Признак видимости поля в интерфейсе
 * @method FieldPatchValueRequest visible(bool $visible) Признак отображения поля в интерфейсе
 * @method FieldPatchValueRequest optionsProvider(array $options) Массив с информацией о допустимых значениях поля. Ключи массива: type, values
 */
class FieldPatchValueRequest extends FieldRequest
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
        'category',
        'order',
        'description',
        'readonly',
        'hidden',
        'visible',
        'optionsProvider',
    ];

    public function __construct(string $fieldId)
    {
        $this->url = self::ACTION.'/'.$fieldId;
    }
}