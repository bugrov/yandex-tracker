<?php

namespace BugrovWeb\YandexTracker\Api\Requests;

use BugrovWeb\YandexTracker\Api\{Client, ClientResponse};
use BugrovWeb\YandexTracker\Exceptions\{TrackerBadMethodException,
    TrackerBadParamsException,
    TrackerBadResponseException,
    TrackerConstructorException
};

/**
 * Расширяемый родительский класс для запросов к API
 */
class Request
{
    /**
     * @var string|null URL запроса
     */
    protected ?string $url;

    /**
     * ACTION - действие в API (например, issue)
     * METHOD - HTTP-метод (например, GET)
     */
    const ACTION = '';
    const METHOD = '';

    /**
     * @var bool Устанавливать заголовок Content-Type: multipart/form-data
     */
    protected bool $multipartRequest = false;

    /**
     * @var bool Отменить проверку на существование магического метода
     */
    protected bool $skipMethodCheck = false;

    /**
     * @var array|array[] Данные для отправки в запросе
     */
    protected array $data = [
        'queryParams' => [],
        'bodyParams'  => [],
    ];

    /**
     * @var array get-параметры, доступные для запроса
     */
    protected array $queryParams = [];

    /**
     * @var array Параметры, доступные в теле запроса
     */
    protected array $bodyParams = [];

    /**
     * Магический метод, использующий прием Method chaining
     *
     * @param string $name
     * @param array $arguments
     * 
     * @return $this
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        switch ($this->skipMethodCheck) {
            case true:
                $this->data['bodyParams'][$name] = $arguments[0];
                break;
            case false:
                if (in_array($name, $this->queryParams)) {
                    $this->data['queryParams'][$name] = is_bool($arguments[0])
                        ? ($arguments[0] ? 'true' : 'false') : $arguments[0];
                } elseif (in_array($name, $this->bodyParams)) {
                    $this->data['bodyParams'][$name] = $arguments[0];
                } else {
                    throw new TrackerConstructorException("Метод $name не существует");
                }
                break;
        }

        return $this;
    }

    /**
     * Шлет запрос с переданными параметрами
     *
     * @return ClientResponse
     *
     * @throws TrackerBadMethodException
     * @throws TrackerBadResponseException
     * @throws TrackerBadParamsException
     */
    public function send(): ClientResponse
    {
        $client = Client::getInstance();

        $client->setMultiPartRequest($this->multipartRequest);

        return $client->prepareRequest(static::METHOD, $this->url, $this->data['bodyParams'], $this->data['queryParams']);
    }
}