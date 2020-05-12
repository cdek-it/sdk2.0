<?php

namespace CdekSDK2\BaseTypes;

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
     * @Type("integer")
     * @var integer
     */
    public $number;
}
