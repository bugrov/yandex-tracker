<?php

namespace BugrovWeb\YandexTracker\Helpers;

class QueryFilter
{
    /**
     * Логическое И
     */
    const LOGIC_AND = 'AND';

    /**
     * Логическое ИЛИ
     */
    const LOGIC_OR = 'OR';

    /**
     * Логическое отрицание
     */
    const PREFIX_NEGATE = '!';

    /**
     * changed(from:)
     */
    const CHANGED_FROM = 'from';

    /**
     * changed(to:)
     */
    const CHANGED_TO = 'to';

    /**
     * changed(by:)
     */
    const CHANGED_BY = 'by';

    /**
     * changed(date:)
     */
    const CHANGED_DATE = 'date';

    protected array $logicPrefixes = ['#', '!', '~', '>', '<', '>=', '<='];

    /**
     * @var string Строка фильтра на языке запросов Яндекс.Трекера
     */
    protected string $queryString;

    public function __construct()
    {
        $this->queryString = '';
    }

    /**
     * Возвращает собранную строку фильтра
     *
     * @return string
     */
    public function toString(): string
    {
        return trim(preg_replace(['/\s\s+/', '/\(\s/', '/\s\)/',], [' ', '(', ')'], $this->queryString));
    }

    /**
     * Начало условия в скобках
     *
     * @return $this
     */
    public function conditionGroup(): self
    {
        $this->appendQuery('(');

        return $this;
    }

    /**
     * Конец условия в скобках
     *
     * @return $this
     */
    public function endConditionGroup(): self
    {
        $this->appendQuery(')');

        return $this;
    }

    /**
     * Вставка логического ИЛИ
     *
     * @return $this
     */
    public function or(): self
    {
        $this->appendQuery(self::LOGIC_OR);

        return $this;
    }

    /**
     * Простой фильтр
     *
     * @param string $field Параметр
     * @param string|array $values Значение(я)
     * @return $this
     */
    public function query(string $field, $values): self
    {
        $queryPart = '"' . $field . '":';

        if (is_array($values)) {
            $queryParts = [];

            foreach ($values as $value) {
                $queryParts[] = $this->prepareValue($value);
            }

            $queryPart .= ' ' . join(', ', $queryParts);

            unset($queryParts);
        } else {
            $queryPart .= ' ' . $this->prepareValue($values);
        }

        $this->appendQuery($queryPart);

        return $this;
    }

    /**
     * Фильтр для интервала времени/чисел
     *
     * @param string $field Параметр
     * @param $from -От
     * @param $to -До
     * @return $this
     */
    public function queryRange(string $field, $from, $to): self
    {
        $this->appendQuery('"' . $field . '": ' . $from . '..' . $to);

        return $this;
    }

    /**
     * Фильтр для параметров с указанием функции времени
     *
     * @param string $field Параметр
     * @param string $dateFunction Функция времени (now(), today() и т.д.)
     * @return $this
     */
    public function date(string $field, string $dateFunction): self
    {
        $this->appendQuery('"' . $field . '": ' . $this->prepareValue($dateFunction, false));

        return $this;
    }

    /**
     * Фильтр для me()
     *
     * @param string $field Параметр
     * @param string|string[]|null $additionalValues Дополнительные параметры
     * @return $this
     */
    public function me(string $field, $additionalValues = null): self
    {
        $firstCharNegate = substr($field, 0, 1) === self::PREFIX_NEGATE;

        $queryPart = '"' . ($firstCharNegate ? substr($field, 1) : $field) . '": ' .
            ($firstCharNegate ? self::PREFIX_NEGATE : '') . 'me()';

        if (!empty($additionalValues)) {
            if (is_array($additionalValues)) {
                $queryParts = [];

                foreach ($additionalValues as $value) {
                    $queryParts[] = $this->prepareValue($value);
                }

                $queryPart .= ', ' . join(', ', $queryParts);

                unset($queryParts);
            } else {
                $queryPart .= ', "' . $additionalValues . '"';
            }
        }

        $this->appendQuery($queryPart);

        return $this;
    }

    /**
     * Фильтр для empty()
     *
     * @param string $field Параметр
     * @return $this
     */
    public function empty(string $field): self
    {
        $this->appendQuery('"' . $field . '": empty()');

        return $this;
    }

    /**
     * Фильтр для notEmpty()
     *
     * @param string $field Параметр
     * @return $this
     */
    public function notEmpty(string $field): self
    {
        $this->appendQuery('"' . $field . '": notEmpty()');

        return $this;
    }

    /**
     * Фильтр для unresolved()
     *
     * @param string $field Параметр
     * @return $this
     */
    public function unresolved(string $field): self
    {
        $this->appendQuery('"' . $field . '": unresolved()');

        return $this;
    }

    /**
     * Фильтр для group()
     *
     * @param string $field Параметр
     * @param string $value Значение
     * @return $this
     */
    public function group(string $field, string $value): self
    {
        $this->appendQuery('"' . $field . '": group(value: ' . $this->prepareValue($value) . ')');

        return $this;
    }

    /**
     * Фильтр для changed()
     *
     * @param string $field Параметр
     * @param array $changes Массив с параметрами from, to, by, date
     * @return $this
     */
    public function changed(string $field, array $changes): self
    {
        $queryPart = '"' . $field . '": changed(';

        foreach ($changes as $key => $value) {
            switch ($key) {
                case self::CHANGED_FROM:
                case self::CHANGED_TO:
                case self::CHANGED_BY:
                    $queryPart .= ' ' . $key . ': ' . $this->prepareValue($value);
                    break;
                case self::CHANGED_DATE:
                    $queryPart .= ' ' . self::CHANGED_DATE . ': ' . $this->prepareValue($value, false);
                    break;
                default:
                    break;
            }
        }

        $queryPart .= ')';

        $this->appendQuery($queryPart);

        return $this;
    }

    /**
     * Подготовка значения для фильтра
     *
     * @param string $value Строка
     * @param bool $quotes Кавычки
     * @return string
     */
    protected function prepareValue(string $value, bool $quotes = true): string
    {
        $value = str_replace('"', '\"', $value);
        $prefix = $this->checkPrefix($value);
        $q = $quotes ? '"' : '';

        return $prefix ? substr($value, 0, $prefix) . $q . substr($value, $prefix) . $q : $q . $value . $q;
    }

    /**
     * Проверяет строку на наличие логического префикса
     *
     * @param string $value Строка
     * @return int
     */
    protected function checkPrefix(string $value): int
    {
        $firstChar = substr($value, 0, 1);
        $firstTwoChar = substr($value, 0, 2);

        return in_array($firstTwoChar, $this->logicPrefixes) ? 2 : (in_array($firstChar, $this->logicPrefixes) ? 1 : 0);
    }

    /**
     * Сортировка фильтра
     *
     * @param string|string[] $field Поле(я) сортировки
     * @return $this
     */
    public function sortBy($field): self
    {
        $queryPart = '"Sort By": ';

        if (is_array($field)) {
            $queryPart .= join(', ', $field);
        } else {
            $queryPart .= $field;
        }

        $this->appendQuery($queryPart);

        return $this;
    }

    /**
     * Конкатенация queryString
     *
     * @param string $query Строка
     */
    protected function appendQuery(string $query)
    {
        $this->queryString .= " $query";
    }
}