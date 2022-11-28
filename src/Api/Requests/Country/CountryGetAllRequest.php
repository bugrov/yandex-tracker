<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Country;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к GET /v2/countries
 */
class CountryGetAllRequest extends CountryRequest
{
    const ACTION = 'countries';
    const METHOD = Client::METHOD_GET;

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}