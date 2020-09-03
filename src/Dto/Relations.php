<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Relations
{
    /**
     * Тип сущности, связанной с заказом
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * @Type("string")
     * @var string
     */
    public $uuid;
}
