<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к PATCH /v2/queues/$queueId/localFields/$fieldKey
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/queues/edit-local-field
 *
 * @method FieldEditLocalRequest name(array $names) Название локального поля. Ключи: en (на английском), ru (на русском)
 * @method FieldEditLocalRequest category(string $id) Идентификатор категории поля. Чтобы получить список категорий, используйте запрос:<br><code>$api->field()->getCategories()->send();</code>
 * @method FieldEditLocalRequest order(int $sort) Порядковый номер в списке полей организации
 * @method FieldEditLocalRequest description(string $text) Описание локального поля
 * @method FieldEditLocalRequest optionsProvider(array $options) Массив с информацией об элементах списка. Ключи массива: type, values
 * @method FieldEditLocalRequest readonly(bool $readonly) Возможность редактировать значение поля
 * @method FieldEditLocalRequest visible(bool $visible) Признак отображения поля в интерфейсе
 * @method FieldEditLocalRequest hidden(bool $hidden) Признак видимости поля в интерфейсе
 */
class FieldEditLocalRequest extends FieldRequest
{
    const ACTION = 'queues';
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
        'name',
        'category',
        'order',
        'description',
        'optionsProvider',
        'readonly',
        'visible',
        'hidden',
    ];

    public function __construct(string $queueId, string $fieldKey)
    {
        $this->url = self::ACTION.'/'.$queueId.'/localFields/'.$fieldKey;
    }
}