<?php

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class CityList
{
    /**
     * Почтовый индекс
     * @Type("array<CdekSDK2\BaseTypes\City>")
     * @var City[]
     */
    public $items;
}
