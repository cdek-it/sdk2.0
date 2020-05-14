<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class City
{
    /**
     * Название населенного пункта
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Код населенного пункта (справочник СДЭК)
     * @Type("int")
     * @var int
     */
    public $code;

    /**
     * Почтовый индекс
     * @Type("array<string>")
     * @var string[]
     */
    public $postal_codes;

    /**
     * Уникальный идентификатор ФИАС населенного пункта
     * @Type("string")
     * @var string
     */
    public $fias_guid;

    /**
     * Код КЛАДР населенного пункта
     * @Type("string")
     * @var string
     */
    public $kladr_code;

    /**
     * Долгота центра населенного пункта
     * @Type("float")
     * @var float
     */
    public $longitude;

    /**
     * Широта центра населенного пункта
     * @Type("float")
     * @var float
     */
    public $latitude;

    /**
     * Название района региона
     * @Type("string")
     * @var string
     */
    public $sub_region;

    /**
     * Название региона
     * @Type("string")
     * @var string
     */
    public $region;

    /**
     * Код региона населенного пункта (справочник СДЭК)
     * @Type("int")
     * @var int
     */
    public $region_code;

    /**
     * Уникальный идентификатор ФИАС региона населенного пункта
     * @Type("string")
     * @var string
     */
    public $fias_region_guid;

    /**
     * Код КЛАДР региона населенного пункта
     * @Type("string")
     * @var string
     */
    public $kladr_region_code;

    /**
     * Название страны населенного пункта
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

    /**
     * Часовой пояс населенного пункта
     * @Type("string")
     * @var string
     */
    public $time_zone;

    /**
     * Ограничение на сумму наложенного платежа в населенном пункте
     * @Type("float")
     * @var float
     */
    public $payment_limit;
}
