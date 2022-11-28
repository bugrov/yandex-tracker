<?php

namespace BugrovWeb\YandexTracker\Api\Requests\Import;

use BugrovWeb\YandexTracker\Api\Client;

/**
 * Класс-конструктор для запроса к POST /v2/issues/_import
 *
 * @see https://cloud.yandex.ru/docs/tracker/concepts/import/import-ticket
 *
 * @method ImportTicketRequest queue(string $key) Ключ очереди. Обязательное
 * @method ImportTicketRequest summary(string $name) Название задачи, не более 255 символов. Обязательное
 * @method ImportTicketRequest createdAt(string $date) Дата и время создания задачи в формате YYYY-MM-DDThh:mm:ss.sss±hhmm. Обязательное
 * @method ImportTicketRequest createdBy(string|int $user) Логин или идентификатор автора задачи. Обязательное
 * @method ImportTicketRequest key(string $key) Ключ задачи. Ключ должен относиться к очереди, в которую импортируется задача
 * @method ImportTicketRequest updatedAt(string $date) Дата и время последнего изменения задачи в формате YYYY-MM-DDThh:mm:ss.sss±hhmm
 * @method ImportTicketRequest updatedBy(string|int $user) Логин или идентификатор пользователя, который редактировал задачу последним
 * @method ImportTicketRequest resolvedAt(string $date) Дата и время проставления резолюции в формате YYYY-MM-DDThh:mm:ss.sss±hhmm
 * @method ImportTicketRequest resolvedBy(string|int $user) Логин или идентификатор пользователя, который проставил резолюцию
 * @method ImportTicketRequest status(int $statusId) Идентификатор статуса задачи
 * @method ImportTicketRequest deadline(string $date) Дедлайн в формате YYYY-MM-DD
 * @method ImportTicketRequest resolution(int $resolutionId) Идентификатор резолюции задачи
 * @method ImportTicketRequest type(int $typeId) Идентификатор типа задачи
 * @method ImportTicketRequest description(string $text) Описание задачи, не более 512000 символов
 * @method ImportTicketRequest start(string $date) Дата начала в формате YYYY-MM-DD
 * @method ImportTicketRequest end(string $date) Дата окончания в формате YYYY-MM-DD
 * @method ImportTicketRequest assignee(string|int $user) Логин или идентификатор исполнителя
 * @method ImportTicketRequest priority(int $priorityId) Идентификатор приоритета
 * @method ImportTicketRequest affectedVersions(array $versionsId) Идентификаторы версий, перечисленные в поле Найдено в версиях
 * @method ImportTicketRequest fixVersions(array $versionsId) Идентификаторы версий, перечисленные в поле Исправить в версиях
 * @method ImportTicketRequest components(array $componentsId) Идентификаторы компонентов, к которым относится задача
 * @method ImportTicketRequest tags(array $tags) Массив тегов задачи
 * @method ImportTicketRequest sprint(array $sprintsId) Идентификаторы спринтов, к которым относится задача
 * @method ImportTicketRequest followers(array $followersId) Массив с идентификаторами или логинами наблюдателей задачи
 * @method ImportTicketRequest access(array $usersId) Массив с идентификаторами или логинами пользователей, перечисленных в поле Доступ
 * @method ImportTicketRequest unique(string $uniqueId) Уникальный идентификатор задачи. Вы можете задать любой идентификатор
 * @method ImportTicketRequest followingMaillists(array $maillistsId) Идентификаторы рассылок — команд и отделов, подписанных на задачу
 * @method ImportTicketRequest originalEstimation(int $milliseconds) Значение параметра "Первоначальная оценка" в миллисекундах
 * @method ImportTicketRequest estimation(int $milliseconds) Значение параметра "Оценка" в миллисекундах
 * @method ImportTicketRequest spent(int $milliseconds) Значение параметра "Затрачено времени" в миллисекундах
 * @method ImportTicketRequest storyPoints(float $storyPoints) Значение параметра Story Points
 * @method ImportTicketRequest votedBy(array $usersId) Массив с идентификаторами или логинами пользователей, которые проголосовали за задачу
 * @method ImportTicketRequest favoritedBy(array $usersId) Массив с идентификаторами или логинами пользователей, которые добавили задачу в избранное
 */
class ImportTicketRequest extends ImportRequest
{
    const ACTION = 'issues/_import';
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
        'queue',
        'summary',
        'createdAt',
        'createdBy',
        'key',
        'updatedAt',
        'updatedBy',
        'resolvedAt',
        'resolvedBy',
        'status',
        'deadline',
        'resolution',
        'type',
        'description',
        'start',
        'end',
        'assignee',
        'priority',
        'affectedVersions',
        'fixVersions',
        'components',
        'tags',
        'sprint',
        'followers',
        'access',
        'unique',
        'followingMaillists',
        'originalEstimation',
        'estimation',
        'spent',
        'storyPoints',
        'votedBy',
        'favoritedBy',
    ];

    public function __construct()
    {
        $this->url = self::ACTION;
    }
}