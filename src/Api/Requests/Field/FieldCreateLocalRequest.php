<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/queues/$queueId/localFields
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/create-local-field
 *
 * @method FieldCreateLocalRequest name(array $names) Название локального поля. Ключи: en (на английском), ru (на русском). Обязательное
 * @method FieldCreateLocalRequest id(string $id) Идентификатор локального поля. Обязательное
 * @method FieldCreateLocalRequest category(string $id) Идентификатор категории поля. Обязательное. Чтобы получить список категорий, используйте запрос:<br><code>$api->field()->getCategories()->send();</code>
 * @method FieldCreateLocalRequest type(string $type) Тип локального поля. Обязательное
 * @method FieldCreateLocalRequest optionsProvider(array $options) Массив с информацией об элементах списка. Ключи массива: type, values
 * @method FieldCreateLocalRequest order(int $sort) Порядковый номер в списке полей организации
 * @method FieldCreateLocalRequest description(string $text) Описание локального поля
 * @method FieldCreateLocalRequest readonly(bool $readonly) Возможность редактировать значение поля
 * @method FieldCreateLocalRequest visible(bool $visible) Признак отображения поля в интерфейсе
 * @method FieldCreateLocalRequest hidden(bool $hidden) Признак видимости поля в интерфейсе
 * @method FieldCreateLocalRequest container(bool $multiple) Признак возможности указать в поле одновременно несколько значений
 */
class FieldCreateLocalRequest extends FieldRequest
{
    const ACTION = 'queues';
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

    public function __construct(string $queueId)
    {
        $this->url = self::ACTION.'/'.$queueId.'/localFields';
    }
}