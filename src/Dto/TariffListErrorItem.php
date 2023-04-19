<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class TariffListErrorItem
{
    /**
     * Код ошибки
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Описание ошибки
     * @Type("string")
     * @var string
     */
    public $message;
}
