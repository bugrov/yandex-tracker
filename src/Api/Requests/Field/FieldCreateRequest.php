<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/fields
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/create-field
 *
 * @method FieldCreateRequest name(array $names) Название поля. Ключи: en (на английском), ru (на русском). Обязательное
 * @method FieldCreateRequest id(string $id) Идентификатор поля. Обязательное
 * @method FieldCreateRequest category(string $id) Идентификатор категории поля. Обязательное. Чтобы получить список категорий, используйте запрос:<br><code>$api->field()->getCategories()->send();</code>
 * @method FieldCreateRequest type(string $type) Тип поля. Обязательное
 * @method FieldCreateRequest optionsProvider(array $options) Массив с информацией об элементах списка. Ключи массива: type, values
 * @method FieldCreateRequest order(int $sort) Порядковый номер в списке полей организации
 * @method FieldCreateRequest description(string $text) Описание поля
 * @method FieldCreateRequest readonly(bool $readonly) Возможность редактировать значение поля
 * @method FieldCreateRequest visible(bool $visible) Признак отображения поля в интерфейсе
 * @method FieldCreateRequest hidden(bool $hidden) Признак видимости поля в интерфейсе
 * @method FieldCreateRequest container(bool $multiple) Признак возможности указать в поле одновременно несколько значений
 */
class FieldCreateRequest extends FieldRequest
{
    const ACTION = 'fields';
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
        'name',
        'id',
        'category',
        'type',
        'optionsProvider',
        'order',
        'description',
        'readonly',
        'visible',
        'hidden',
        'container',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}