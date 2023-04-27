<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Tariff
{
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
     * Расчетный вес (в граммах)
     * @Type("integer")
     * @var integer
     */
    public $weight_calc;

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

    /**
     * Стоимость доставки с учетом дополнительных услуг
     * @Type("integer")
     * @var integer
     */
    public $total_sum;

    /**
     * Валюта, в которой рассчитана стоимость доставки (код СДЭК)
     * @Type("string")
     * @var string
     */
    public $currency;

    /**
     * Список регионов
     * @Type("array<CdekSDK2\Dto\TariffService>")
     * @var TariffService[]
     */
    public $services;
}
