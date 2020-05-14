<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Region
{
    /**
     * Название региона
     * @Type("string")
     * @var string
     */
    public $region;

    /**
     * Код региона СДЭК
     * @Type("int")
     * @var int
     */
    public $region_code;

    /**
     * Уникальный идентификатор ФИАС региона
     * @Type("string")
     * @var string
     */
    public $fias_region_guid;

    /**
     * Код КЛАДР региона
     * @Type("string")
     * @var string
     */
    public $kladr_region_code;

    /**
     * Название страны региона
     * @Type("string")
     * @var string
     */
    public $country;

    /**
     * Код страны в формате ISO_3166-1_alpha-2
     * @example RU, DE, TR
     * @Type("string")
     * @var string
     */
    public $country_code;
}
