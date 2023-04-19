<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class TariffListItem
{
    /**
     * Код тарифа
     * @Type("integer")
     * @var integer
     */
    public $tariff_code;

    /**
     * Название тарифа на языке вывода
     * @Type("string")
     * @var string
     */
    public $tariff_name;

    /**
     * Описание тарифа на языке вывода
     * @Type("string")
     * @var string
     */
    public $tariff_description;

    /**
     * Режим тарифа
     * @Type("integer")
     * @var integer
     */
    public $delivery_mode;

    /**
     * Стоимость доставки
     * @Type("float")
     * @var float
     */
    public $delivery_sum;

    /**
     * Минимальное время доставки (в рабочих днях)
     * @Type("integer")
     * @var integer
     */
    public $period_min;

    /**
     * Максимальное время доставки (в рабочих днях)
     * @Type("integer")
     * @var integer
     */
    public $period_max;

    /**
     * Минимальное время доставки (в календарных днях)
     * @Type("integer")
     * @var integer
     */
    public $calendar_min;

    /**
     * Максимальное время доставки (в календарных днях)
     * @Type("integer")
     * @var integer
     */
    public $calendar_max;
}
