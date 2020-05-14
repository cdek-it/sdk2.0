<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Warning
{
    /**
     * Код предупреждения
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Описание предупреждения
     * @Type("string")
     * @var string
     */
    public $message;
}
