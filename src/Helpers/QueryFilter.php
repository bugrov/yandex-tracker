<?php

namespace BugrovWeb\YandexTracker\Helpers;

/**
 * Конструктор query-запросов Яндекс.Трекера
 *
 * @see https://cloud.yandex.ru/docs/tracker/user/query-filter
 */
class QueryFilter
{
    /**
     * @var array Массив всех частей query
     */
    protected array $wheres;

    /**
     * @var array Массив с сортировкой
     */
    protected array $sortBy;

    /**
     * @var array|string[] Query-функции
     */
    protected array $queryFunctions = [
        'empty()',
        'notEmpty()',
        'me()',
        'now()',
        'today()',
        'week()',
        'month()',
        'quarter()',
        'year()',
        'unresolved()',
    ];

    public function __construct()
    {
        $this->wheres = [];
        $this->sortBy = [];
    }

    /**
     * @return $this
     */
    public function newQuery(): self
    {
        return new static();
    }

    /**
     * Создает новый вложенный query
     *
     * @return $this
     */
    public function forNestedWhere(): self
    {
        return $this->newQuery();
    }

    /**
     * Получает текущий массив частей query
     *
     * @return array
     */
    public function getWheres(): array
    {
        return $this->wheres;
    }

    /**
     * Добавляет базовый запрос
     *
     * @param \Closure|string|array $field
     * @param mixed $operator
     * @param mixed $value
     * @param string $boolean
     * @return $this
     */
    public function where($field, $operator = null, $value = null, string $boolean = 'AND'): self
    {
        if (is_array($field)) {
            return $this->addArrayOfWheres($field, $boolean);
        }
        
        [$value, $operator] = $this->prepareValueAndOperator(
            $value, $operator, func_num_args() === 2
        );

        if ($field instanceof \Closure && is_null($operator)) {
            return $this->nestedWhere($field, $boolean);
        }

        if (is_array($value) && (is_null($operator) || $operator === '')) {
            foreach ($value as &$valuePart) {
                $valuePart = $this->prepareValue($valuePart);
            }

            $value = join(', ', $value);
        } else {
            $value = $this->prepareValue($value);
        }

        $type = 'Basic';

        $this->wheres[] = compact(
            'type', 'field', 'operator', 'value', 'boolean'
        );

        return $this;
    }

    /**
     * Добавляет базовый запрос через ИЛИ
     *
     * @param \Closure|string|array $field
     * @param mixed $operator
     * @param mixed $value
     * @return $this
     */
    public function orWhere($field, $operator = null, $value = null): self
    {
        [$value, $operator] = $this->prepareValueAndOperator(
            $value, $operator, func_num_args() === 2
        );

        return $this->where($field, $operator, $value, 'OR');
    }

    /**
     * Добавляет запрос с интервалом значений $a .. $b
     *
     * @param string $field
     * @param array $values
     * @param string $boolean
     * @return $this
     */
    public function whereIsBetween(string $field, array $values, string $boolean = 'AND'): self
    {
        $value = '{{' . join(' .. ', array_slice($values, 0, 2)) . '}}';

        return $this->where($field, null, $value, $boolean);
    }

    /**
     * Добавляет запрос с интервалом значений $a .. $b через ИЛИ
     *
     * @param string $field
     * @param array $values
     * @return $this
     */
    public function orWhereIsBetween(string $field, array $values): self
    {
        return $this->whereIsBetween($field, $values, 'OR');
    }

    /**
     * Добавляет запрос с empty()
     *
     * @param array|string $fields
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereIsEmpty($fields, string $boolean = 'AND', bool $not = false): self
    {
        $fields = is_array($fields) ? $fields : [$fields];
        $value = $not ? 'notEmpty()' : 'empty()';

        foreach ($fields as $field) {
            $this->where($field, null, $value, $boolean);
        }

        return $this;
    }

    /**
     * Добавляет запрос с empty() через ИЛИ
     *
     * @param array|string $field
     * @return $this
     */
    public function orWhereIsEmpty($field): self
    {
        return $this->whereIsEmpty($field, 'OR');
    }

    /**
     * Добавляет запрос с notEmpty()
     *
     * @param array|string $fields
     * @param string $boolean
     * @return $this
     */
    public function whereIsNotEmpty($fields, string $boolean = 'AND'): self
    {
        return $this->whereIsEmpty($fields, $boolean, true);
    }

    /**
     * Добавляет запрос с notEmpty() через ИЛИ
     *
     * @param array|string $field
     * @return $this
     */
    public function orWhereIsNotEmpty($field): self
    {
        return $this->whereIsNotEmpty($field, 'OR');
    }

    /**
     * Добавляет запрос с me()
     *
     * @param array|string $fields
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereIsMe($fields, string $boolean = 'AND', bool $not = false): self
    {
        $fields = is_array($fields) ? $fields : [$fields];
        $value = $not ? '!me()' : 'me()';

        foreach ($fields as $field) {
            $this->where($field, null, $value, $boolean);
        }

        return $this;
    }

    /**
     * Добавляет запрос с me() через ИЛИ
     *
     * @param array|string $field
     * @return $this
     */
    public function orWhereIsMe($field): self
    {
        return $this->whereIsMe($field, 'OR');
    }

    /**
     * Добавляет запрос с !me()
     *
     * @param array|string $fields
     * @param string $boolean
     * @return $this
     */
    public function whereIsNotMe($fields, string $boolean = 'AND'): self
    {
        return $this->whereIsMe($fields, $boolean, true);
    }

    /**
     * Добавляет запрос с !me() через ИЛИ
     *
     * @param array|string $field
     * @return $this
     */
    public function orWhereIsNotMe($field): self
    {
        return $this->whereIsNotMe($field, 'OR');
    }

    /**
     * Добавляет запрос с unresolved()
     *
     * @param array|string $fields
     * @param string $boolean
     * @return $this
     */
    public function whereIsUnresolved($fields, string $boolean = 'AND'): self
    {
        $fields = is_array($fields) ? $fields : [$fields];

        foreach ($fields as $field) {
            $this->where($field, null, 'unresolved()', $boolean);
        }

        return $this;
    }

    /**
     * Добавляет запрос с unresolved() через ИЛИ
     *
     * @param array|string $field
     * @return $this
     */
    public function orWhereIsUnresolved($field): self
    {
        return $this->whereIsUnresolved($field, 'OR');
    }

    /**
     * Добавляет запрос вида "Параметр": group(value: "Значение")
     *
     * @param array|string $fields
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function whereIsGroup($fields, string $value, string $boolean = 'AND'): self
    {
        $fields = is_array($fields) ? $fields : [$fields];
        $valuePrepared = '{{group(value: "' . str_replace('"', '\"', $value) . '")}}';

        foreach ($fields as $field) {
            $this->where($field, null, $valuePrepared, $boolean);
        }

        return $this;
    }

    /**
     * Добавляет запрос вида "Параметр": group(value: "Значение") через ИЛИ
     *
     * @param array|string $field
     * @param string $value
     * @return $this
     */
    public function orWhereIsGroup($field, string $value): self
    {
        return $this->whereIsGroup($field, $value, 'OR');
    }

    /**
     * Добавляет запрос вида "Параметр": changed(from: "from" to: "to", by: "by" date: "date")
     *
     * @param string $field
     * @param array $values
     * @param string $boolean
     * @return $this
     */
    public function whereIsChanged(string $field, array $values, string $boolean = 'AND'): self
    {
        $valuePrepared = '{{changed(';
        $valueParts = [];

        foreach ($values as $key => $var) {
            if ($key === 'date') {
                if (is_array($var)) {
                    $var = join(' .. ', array_slice($var, 0, 2));
                }

                $valueParts[] = $key . ': ' . $var;
            } else {
                $valueParts[] = $key . ': "'  . str_replace('"', '\"', $var) . '"';
            }
        }

        $valuePrepared .= join(' ', $valueParts) . ')}}';

        return $this->where($field, null, $valuePrepared, $boolean);
    }

    /**
     * Добавляет запрос вида "Параметр": changed(from: "from" to: "to", by: "by" date: "date") через ИЛИ
     *
     * @param string $field
     * @param array $values
     * @return $this
     */
    public function orWhereIsChanged(string $field, array $values): self
    {
        return $this->whereIsChanged($field, $values, 'OR');
    }

    /**
     * Добавляет в запрос вложенный запрос
     *
     * @param \Closure $callback
     * @param string $boolean
     * @return $this
     */
    public function nestedWhere(\Closure $callback, string $boolean = 'AND'): self
    {
        call_user_func($callback, $query = $this->forNestedWhere());

        return $this->addNestedWhereQuery($query->getWheres(), $boolean);
    }

    /**
     * Заполняет текущий конструктор значениями из вложенного запроса
     *
     * @param array $query
     * @param string $boolean
     * @return $this
     */
    public function addNestedWhereQuery(array $query, string $boolean = 'AND'): self
    {
        if (count($query)) {
            $type = 'Nested';

            $this->wheres[] = compact('type', 'query', 'boolean');
        }

        return $this;
    }

    /**
     * Добавляет рекурсивно запросы на основе массива
     *
     * @param array $field
     * @param string $boolean
     * @param string $method
     * @return $this
     */
    public function addArrayOfWheres(array $field, string $boolean, string $method = 'where'): self
    {
        return $this->nestedWhere(function ($query) use ($field, $method, $boolean) {
            foreach ($field as $key => $value) {
                if (is_numeric($key) && is_array($value)) {
                    $query->{$method}(...array_values($value));
                } else {
                    $query->$method($key, '', $value, $boolean);
                }
            }
        }, $boolean);
    }

    /**
     * Устанавливает сортировку запроса
     *
     * @param array|string $field
     * @return $this
     */
    public function sortBy($field): self
    {
        $field = is_array($field) ? $field : [$field];
        $this->sortBy = array_merge($this->sortBy, $field);

        return $this;
    }

    /**
     * Возвращает итоговую строку запроса
     *
     * @return string|null
     */
    public function toString(): ?string
    {
        $queryString = '';

        $basicQueries = array_values(array_filter($this->wheres, function ($query) {
            return $query['type'] === 'Basic';
        }));

        $nestedQueries = array_values(array_filter($this->wheres, function ($query) {
            return $query['type'] === 'Nested';
        }));

        foreach ($basicQueries as $bIndex => $basicQuery) {
            $queryString .= $this->generateString($basicQuery, $bIndex !== 0);
        }

        foreach ($nestedQueries as $nestedQuery) {
            $queryString .= ' ' . $nestedQuery['boolean'] . ' (';

            foreach ($nestedQuery['query'] as $index => $query) {
                $queryString .= $this->generateString($query, $index !== 0);
            }

            $queryString .= ')';
        }

        if (!empty($this->sortBy)) {
            $queryString .= ' "Sort By": ' . join(', ', $this->sortBy);
        }

        return $this->finalPrepare($queryString) ?: '';
    }

    /**
     * Финальная подготовка строки запроса: trim и обрезка лишних логических операторов
     *
     * @param string $queryString
     * @return string|null
     */
    protected function finalPrepare(string $queryString): ?string
    {
        return preg_replace(['/^\s?AND\s?/', '/^\s?OR\s?/'], '', trim($queryString));
    }

    /**
     * Генерация части строки запроса
     *
     * @param array $query
     * @param bool $firstBoolean
     * @return string
     */
    protected function generateString(array $query, bool $firstBoolean = true): string
    {
        return ($firstBoolean ? ' ' . $query['boolean'] . ' ' : '') . '"' . $query['field'] . '": ' . ($query['operator'] ?: '') . $query['value'];
    }

    /**
     * Подготовка отдельных значений каждого массива $this->wheres
     *
     * @param mixed $value
     * @return string
     */
    protected function prepareValue($value): string
    {
        $replacedValue = $this->notReplaceQuotes($value);

        $addQuotes = !$this->valueHasFunction($value) && !is_int($value) && !$replacedValue;

        $value = $replacedValue ?: str_replace('"', '\"', $value);

        return trim(($addQuotes ? '"' : '') . $value . ($addQuotes ? '"' : ''));
    }

    /**
     * Заменить у значения кавычки c " на \"
     *
     * @param mixed $value
     * @return array|mixed
     */
    protected function notReplaceQuotes($value)
    {
        preg_match('/\{\{(.+)\}\}/', $value, $matches);

        return $matches ? $matches[1] : [];
    }

    /**
     * Проверяет, что значение содержит функцию из Яндекс.Трекера
     *
     * @param mixed $value
     * @return bool
     */
    protected function valueHasFunction($value): bool
    {
        $matches = array_filter($this->queryFunctions, function($var) use ($value) {
            return strpos($value, $var) !== false;
        });

        return !empty($matches);
    }

    /**
     * Подготавливает значение и оператор для запроса
     *
     * @param mixed $value
     * @param mixed $operator
     * @param bool $useDefault
     * @return array
     */
    public function prepareValueAndOperator($value, $operator, bool $useDefault = false): array
    {
        if ($useDefault) {
            return [$operator, ''];
        }

        return [$value, $operator];
    }
}