<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class PickupImage
{
    /**
     * Ссылка на фото
     * @Type("string")
     * @var string
     */
    public $url;

    /**
     * Номер фото
     * @Type("int")
     * @var int
     */
    public $number;
}
