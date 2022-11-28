<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\External\{ExternalAddLinkRequest,
    ExternalDeleteLinkRequest,
    ExternalGetApplicationsRequest,
    ExternalGetLinksRequest,
    ExternalRequest
};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с внешними приложениями. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method ExternalGetApplicationsRequest getApplications() Получить список внешних приложений
 * @method ExternalGetLinksRequest getLinks(string $issueId) Получить список внешних связей задачи
 * @method ExternalAddLinkRequest addLink(string $issueId) Добавить внешнюю связь
 * @method ExternalDeleteLinkRequest deleteLink(string $issueId, string $externalLinkId) Удалить внешнюю связь
 */
class External extends TrackerAction
{
    /**
     * @var array|string[] Запросы, доступные для работы с внешними приложениями
     */
    protected array $methodsList = [
        'getApplications',
        'getLinks',
        'addLink',
        'deleteLink',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return ExternalRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\External\\'.'External'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}