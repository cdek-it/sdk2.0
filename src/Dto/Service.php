<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

/**
 * Class Request
 * @package CdekSDK2\Dto
 */
class Service
{

    /**
     * Тип дополнительной услуги, код из справочника доп. услуг
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Стоимость услуги
     * @Type("float")
     * @var float
     */
    public $sum;
}
