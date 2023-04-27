<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class TariffList
{
    /**
     * Список регионов
     * @Type("array<CdekSDK2\Dto\TariffListItem>")
     * @var TariffListItem[]
     */
    public $tariff_codes;
}
