<?php

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class RegionList
{
    /**
     * Почтовый индекс
     * @Type("array<CdekSDK2\BaseTypes\Region>")
     * @var Region[]
     */
    public $items;
}
