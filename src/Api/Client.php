<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Exceptions\TrackerBadMethodException;
use BugrovWeb\YandexTracker\Exceptions\TrackerBadParamsException;
use BugrovWeb\YandexTracker\Exceptions\TrackerBadResponseException;
use BugrovWeb\YandexTracker\Helpers\ErrorCode;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Utils;

class Client
{
    /**
     * Адрес узла, предоставляющего API
     */
    const HOST_API = 'https://api.tracker.yandex.net';

    /**
     * Версия API
     */
    const API_VERSION = 'v2';

    /**
     * Доступные HTTP-методы
     */
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var bool Устанавливать аголовок Content-Type multipart/form-data
     */
    protected bool $isMultiPartRequest = false;

    /**
     * @var string OAuth-токен
     */
    protected string $token;

    /**
     * @var string Идентификатор организации
     */
    protected string $orgId;

    private static ?Client $instance = null;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Устанавливает OAuth-токен
     *
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Устанавливает идентификатор организации
     *
     * @param string $xOrgId
     * @return $this
     */
    public function setOrgId(string $xOrgId): self
    {
        $this->orgId = $xOrgId;

        return $this;
    }

    /**
     * Устанавливает флаг isMultiPartRequest
     *
     * @param bool $set
     * @return $this
     */
    public function setMultiPartRequest(bool $set): self
    {
        $this->isMultiPartRequest = $set;

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @param null|string|resource $body
     *
     * @return ClientResponse
     *
     * @throws TrackerBadResponseException
     * @throws TrackerBadParamsException
     */
    protected function getResponse(string $url, string $method, $body): ClientResponse
    {
        $client = new HttpClient(['base_uri' => self::HOST_API.'/'.self::API_VERSION.'/']);

        $options = [
            'headers'=> [
                'Authorization' => 'OAuth '.$this->token,
                'X-Org-ID'      => $this->orgId,
            ],
        ];

        if ($this->isMultiPartRequest) {
            if (!is_string($body) && !is_resource($body)) {
                throw new TrackerBadParamsException('Тело запроса должно быть типа string или resource');
            }

            $options['multipart'] = [
                [
                    'name' => 'file',
                    'contents'  => is_string($body)
                        ? Utils::tryFopen($body, 'r') : $body,
                ]
            ];
        } else {
            $options['body'] = $body;
        }

        try {
            $response = $client->request($method, $url, $options);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $exception = (string) $e->getResponse()->getBody();
                $exceptionData = json_decode($exception, true);

                $error = $exceptionData['errors'] ? implode('; ', array_map(
                    function ($v, $k) {
                        return $k . ': ' . $v;
                    },
                    $exceptionData['errors'],
                    array_keys($exceptionData['errors'])
                )) : '';
                $errorMessage = $error ?: $exceptionData['errorMessages'][0] ?: '';

                if (!empty($errorMessage)) {
                    throw new TrackerBadResponseException($errorMessage, $e->getCode());
                } else {
                    throw new TrackerBadResponseException(
                        ErrorCode::getErrorMessage($e->getCode()),
                        $e->getCode()
                    );
                }
            } else {
                throw new TrackerBadResponseException(
                    ErrorCode::getErrorMessage($e->getCode()),
                    $e->getCode()
                );
            }
        }

        return new ClientResponse($response);
    }

    /**
     * Подготавливает запрос для API
     *
     * @param string $method HTTP метод
     * @param string $url url запроса
     * @param null|array|string|resource $body тело запроса
     * @param array $queryParams get-параметры url
     *
     * @return ClientResponse
     *
     * @throws TrackerBadMethodException
     * @throws TrackerBadResponseException
     * @throws TrackerBadParamsException
     */
    public function prepareRequest(
        string $method,
        string $url,
        $body,
        array  $queryParams = []
    ): ClientResponse
    {
        $queryParams = $this->prepareQuery($queryParams);

        $methodUrl = $url . $queryParams;

        $body = $this->prepareBody($body);

        switch ($method) {
            case self::METHOD_GET:
            case self::METHOD_DELETE:
            case self::METHOD_POST:
            case self::METHOD_PATCH:
            case self::METHOD_PUT:
                return $this->getResponse($methodUrl, $method, $body);
            default:
                throw new TrackerBadMethodException("Недопустимое значение метода: $method. Допустимые: GET, POST, PATCH, PUT, DELETE");
        }
    }

    /**
     * Собирает get-параметры для урла
     *
     * @param array $queryParams query-параметры для GET
     * @return string
     */
    protected function prepareQuery(array $queryParams): string
    {
        return !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
    }

    /**
     * Подготовка тела запроса для POST, PUT и PATCH методов
     *
     * @param null|array|string|resource $body тело запроса
     * @return string|array|resource
     */
    protected function prepareBody($body)
    {
        if ($this->isMultiPartRequest) return $body;

        return !empty($body) ? json_encode($body) : '';
    }
    
    private function __construct(){}
    private function __clone(){}
}