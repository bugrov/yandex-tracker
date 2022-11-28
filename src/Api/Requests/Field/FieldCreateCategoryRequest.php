<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/fields/categories
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/issues/create-issue-field-category
 *
 * @method FieldCreateCategoryRequest name(array $name) Название категории. Ключи: en (на английском), ru (на русском). Обязательное
 * @method FieldCreateCategoryRequest order(int $sort) Вес поля при отображении в интерфейсе. Обязательное
 * @method FieldCreateCategoryRequest description(string $text) Описание категории
 */
class FieldCreateCategoryRequest extends FieldRequest
{
    const ACTION = 'fields/categories';
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
        'order',
        'description',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}