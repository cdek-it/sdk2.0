<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

/**
 * Class Statuses
 * @package CdekSDK2\Dto
 */
class Statuses
{
    /**
     * Код статуса
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Название статуса
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Дополнительный код статуса
     * @Type("string")
     * @var string
     */
    public $reason_code;

    /**
     * Дата и время установки статуса
     * @Type("string")
     * @var string
     */
    public $date_time;

    /**
     * Наименование города(места), где произошло изменение статуса
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Код населенного пункта возникновения статуса
     * @Type("int")
     * @var int
     */
    public $city_code;
}
