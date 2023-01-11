<?php

namespace BugrovWeb\YandexTracker\Helpers;

use BugrovWeb\YandexTracker\Exceptions\TrackerBadParamsException;
use DateInterval;
use DateTime;

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
     * Кол-во рабочих дней в неделе
     */
    const WORKDAYS_IN_WEEK = 5;

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
     * Проверяем корректность метки времени. Удаляем у секунд миллисекунды + возращаем недели в РАБОЧИХ днях
     *
     * @param string $isoTime Метка времени в ISO 8601
     *
     * @throws \Exception
     */
    protected function prepareISOTime(string $isoTime): DateInterval
    {
        $isoTime = preg_replace('/\.\d+/', '', $isoTime);

        if (preg_match('/^P(\d+)W$/', $isoTime, $matches)) {
            $isoTime = self::TIME_PREFIX . $matches[1] * self::WORKDAYS_IN_WEEK . 'D';
        }

        return new DateInterval($isoTime);
    }

    /**
     * Возвращает рассчитанное время в удобочитаемом формате
     *
     * @param array|string[]|string $isoTime Метка времени в ISO 8601
     *
     * @throws \Exception
     */
    public function getTotalTime($isoTime): string
    {
        $startPoint = new DateTime('00:00');
        $cloneTime = clone $startPoint;

        if (is_array($isoTime)) {
            foreach ($isoTime as $time) {
                $startPoint->add($this->prepareISOTime($time));
            }
        } else {
            $startPoint->add($this->prepareISOTime($isoTime));
        }

        $days = $cloneTime->diff($startPoint)->d;
        $hours = $cloneTime->diff($startPoint)->h;

        if ($days) {
            $hours = $days * 8 + $hours;
            $startPoint->sub(new DateInterval("P{$days}D"));
        }

        return "{$hours}h ". $cloneTime->diff($startPoint)->format('%im %ss');
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