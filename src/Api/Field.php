<?php

namespace BugrovWeb\YandexTracker\Api;

use BugrovWeb\YandexTracker\Api\Requests\Field\{FieldCreateLocalRequest,
    FieldCreateRequest,
    FieldEditLocalRequest,
    FieldGetCategoriesRequest,
    FieldGetGlobalsRequest,
    FieldGetInfoLocalRequest,
    FieldGetLocalsRequest,
    FieldGetParamsRequest,
    FieldPatchNameRequest,
    FieldPatchValueRequest,
    FieldRequest,
    FieldCreateCategoryRequest};
use BugrovWeb\YandexTracker\Exceptions\TrackerConstructorException;

/**
 * Класс для работы с полями задач. Выдает определенный экземпляр класса на основе магического метода
 *
 * @method FieldGetGlobalsRequest getGlobals() Получить глобальные поля
 * @method FieldGetCategoriesRequest getCategories() Получить список всех категорий полей
 * @method FieldCreateRequest create() Создать поле задачи
 * @method FieldGetParamsRequest getParams(string $fieldId) Получить параметры поля задачи
 * @method FieldPatchNameRequest patchName(string $fieldId) Изменить название поля задачи
 * @method FieldPatchValueRequest patchValue(string $fieldId) Изменить возможные значения поля задачи
 * @method FieldCreateCategoryRequest createCategory() Создать категорию поля задачи
 * @method FieldCreateLocalRequest createLocal(string $queueId) Создать локальное поле очереди
 * @method FieldGetLocalsRequest getLocals(string $queueId) Получить локальные поля очереди
 * @method FieldGetInfoLocalRequest getInfoLocal(string $queueId, string $fieldKey) Получить информацию о локальном поле очереди
 * @method FieldEditLocalRequest editLocal(string $queueId, string $fieldKey) Редактировать локальное поле очереди
 */
class Field extends TrackerAction
{
    /**
     * Тип поля Дата
     */
    const TYPE_DATE = 'ru.yandex.startrek.core.fields.DateFieldType';
    /**
     * Тип поля Дата/Время
     */
    const TYPE_DATETIME = 'ru.yandex.startrek.core.fields.DateTimeFieldType';
    /**
     * Тип поля Текстовое однострочное поле
     */
    const TYPE_STRING = 'ru.yandex.startrek.core.fields.StringFieldType';
    /**
     * Тип поля Текстовое многострочное поле
     */
    const TYPE_TEXT = 'ru.yandex.startrek.core.fields.TextFieldType';
    /**
     * Тип поля Дробное число
     */
    const TYPE_FLOAT = 'ru.yandex.startrek.core.fields.FloatFieldType';
    /**
     * Тип поля Целое число
     */
    const TYPE_INT = 'ru.yandex.startrek.core.fields.IntegerFieldType';
    /**
     * Тип поля Имя пользователя
     */
    const TYPE_USER = 'ru.yandex.startrek.core.fields.UserFieldType';
    /**
     * Тип поля Ссылка
     */
    const TYPE_URI = 'ru.yandex.startrek.core.fields.UriFieldType';
    /**
     * Тип выпадающего списка: список строковых или числовых значений
     */
    const OPTIONS_PROVIDER_LIST = 'FixedListOptionsProvider';
    /**
     * Тип выпадающего списка: список пользователей
     */
    const OPTIONS_PROVIDER_USER_LIST = 'FixedUserListOptionsProvider';

    /**
     * @var array|string[] Запросы, доступные для работы с полями задач
     */
    protected array $methodsList = [
        'getGlobals',
        'getCategories',
        'create',
        'getParams',
        'patchName',
        'patchValue',
        'createCategory',
        'createLocal',
        'getLocals',
        'getInfoLocal',
        'editLocal',
    ];

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return FieldRequest
     *
     * @throws TrackerConstructorException
     */
    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, $this->methodsList)) {
            throw new TrackerConstructorException("Метод $name не существует");
        }

        $className = __NAMESPACE__.'\\Requests\\Field\\'.'Field'.ucfirst($name).'Request';

        try {
            return new $className(...$arguments);
        } catch (\Exception $e) {
            throw new TrackerConstructorException("Класс $className не найден");
        }
    }
}