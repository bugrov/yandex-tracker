<?php

namespace BugrovWeb\YandexTracker\Helpers;

use BugrovWeb\YandexTracker\Exceptions\TrackerBadParamsException;

/**
 * Класс-билдер времени в формате PnYnMnDTnHnMnS, PnW в соответствии с ISO 8601
 *
 * @see https://dotat.at/tmp/ISO_8601-2004_E.pdf
 *
 * @method TimeManager year(int $year) Установить год (Y)
 * @method TimeManager month(int $month) Установить месяц (M)
 * @method TimeManager week(int $week) Установить неделю (W)
 * @method TimeManager day(int $day) Установить день (D)
 * @method TimeManager hour(int $hour) Установить часы (H)
 * @method TimeManager minute(int $minute) Установить минуты (M)
 * @method TimeManager second(int $second) Установить секунды (S)
 */
class TimeManager
{
    protected int $year, $month, $week, $day, $hour, $minute, $second;

    /**
     * @var array|string[] Соответствия года, месяца, недели, дня для ISO 8601
     */
    protected array $timeFirstCompliance = [
        'year' => 'Y',
        'month' => 'M',
        'week' => 'W',
        'day' => 'D',
    ];

    /**
     * @var array|string[] Соответствия часов, минут, секунд для ISO 8601
     */
    protected array $timeSecondCompliance = [
        'hour' => 'H',
        'minute' => 'M',
        'second' => 'S',
    ];

    /**
     * Начальный указатель времени
     */
    const TIME_PREFIX = 'P';
    /**
     * Разделитель часов, минут, секунд
     */
    const TIME_SEPARATOR = 'T';

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return $this
     *
     * @throws TrackerBadParamsException
     */
    public function __call(string $name, array $arguments)
    {
        if (
            !array_key_exists($name, $this->timeFirstCompliance)
            && !array_key_exists($name, $this->timeSecondCompliance)
        ) {
            throw new TrackerBadParamsException("Метод $name не существует");
        }

        if (!is_int($arguments[0])) {
            throw new TrackerBadParamsException('Введите числовое значение');
        }

        $this->$name = $arguments[0];

        return $this;
    }

    /**
     * Возвращает компактный массив заданного времени
     *
     * @return array
     */
    protected function getVars(): array
    {
        extract(get_object_vars($this));
        return compact('year', 'month', 'week', 'day', 'hour', 'minute', 'second');
    }

    /**
     * Возвращает метку времени в формате PnYnMnDTnHnMnS, PnW
     *
     * @return string
     * @throws TrackerBadParamsException
     */
    public function getISOTime(): string
    {
        $allVars = $this->getVars();

        if (!empty($allVars['week']) && !empty(array_values(array_diff_key($allVars, array_flip(['week']))))) {
            throw new TrackerBadParamsException('Задайте что-то одно: только неделю/год, месяц, день, минуты, секунды');
        }

        $firstTimePart = '';
        $secondTimePart = '';

        foreach ($this->timeFirstCompliance as $timePrefix => $isoTimeParam) {
            if (!empty($this->$timePrefix)) {
                $firstTimePart .= $this->$timePrefix . $isoTimeParam;
            }
        }

        foreach ($this->timeSecondCompliance as $timePrefix => $isoTimeParam) {
            if (!empty($this->$timePrefix)) {
                $secondTimePart .= $this->$timePrefix . $isoTimeParam;
            }
        }

        if (!$firstTimePart && !$secondTimePart) return '';

        return self::TIME_PREFIX . $firstTimePart . ($secondTimePart ? self::TIME_SEPARATOR : '') . $secondTimePart;
    }
}