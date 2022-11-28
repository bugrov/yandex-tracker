<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Field;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/fields/categories
 */
class FieldGetCategoriesRequest extends FieldRequest
{
    const ACTION = 'fields/categories';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}